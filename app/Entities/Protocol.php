<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
	protected $fillable = array('name', 'description', 'user_id');
	public $timestamps = true;
	public $increments = true;
    
    public function getSurveyAviableAttribute()
    {
        if($survey = $this->survey)
        {
            return $survey->aviable;
        }

        return false;
    }

    public function getUserValueAttribute()
    {
        return $this->user->name;
    }

    public function getCategoriesListsAttribute()
    {
        return $this->categories->lists('id');
    }

    public function getAreasListsAttribute()
    {
        if(!is_null($this->survey))
        {
            return $this->survey->areas_lists;  
        }
    }

    public function getRolesListsAttribute()
    {
        if(!is_null($this->survey))
        {
            return $this->survey->roles_lists;
        }
    }

    /* Exams */

    public function lastExam()
    {
        $examScore = $this->examScores->sortByDesc('updated_at')->first();

        if(!is_null($examScore))
        {
            return $examScore;
        }

        return null;
    }

    public function isPdfCorrect()
    {
        if(!is_null($this->url_pdf))
        {
            return true;
        }

        return false;
    }

    public function getPdfAttribute()
    {
        if($this->isPdfCorrect())
        {
            return $this->url_pdf;
        }

        return '#';
    }

    public function getLastExamUpdateAttribute()
    {
        if($examScore = $this->lastExam())
        {
            return $examScore->updated_at;
        } 

        return 'SIN EXAMEN';
    }

    public function getLastExamScoreAttribute()
    {
        if($examScore = $this->lastExam())
        {
            return $examScore->formated_score;
        } 

        return 'NA';
    }

    public function bestExam()
    {
        $examScore = $this->examScores->sortByDesc('score')->first();

        if(!is_null($examScore))
        {
            return $examScore;
        }

        return null;
    }

    public function getBestExamScoreAttribute()
    {
        if($exam = $this->bestExam())
        {
            return $exam->formated_score;
        }

        return 'NA';
    }

    public function getbestExamStatusAttribute()
    {
        if($exam = $this->bestExam())
        {
            if($exam->score > 80){
                return 'APROBADO';
            }
            else
            {
                return 'SIN APROBAR';
            }
        }

        return 'NO PRESENTADO';
    }

    public function getNumberAnnexAttribute()
    {
        return $this->annex->count();
    }

    public function getNumberQuestionsAttribute()
    {
        return $this->survey->number_questions;
    }

    /* End Exams */

    /***** Relations *****/





    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** 
     * Relation
     * @return Education\Entities\Protocol
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }

    public function annexes()
    {
        return $this->hasMany('Annex', 'protocol_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /***** End Relations *****/

    public function getAnnexFileAttribute()
    {
        $annex = $this->annex->filter(function($annex)
        {
            return $annex->isFile();
        });

        return $annex;
    }

    public function getAnnexLinkAttribute()
    {
        $links = $this->annex->filter(function($annex)
        {
            return $annex->isLink();
        });

        return $links;
    }

    /***** Scopes *****/

    public function scopeUserCanStudy($query, $user_id)
    {
        return $query->joinCanStudyProtocols()
            ->where('users_has_access_surveys.user_id', $user_id);
    }

    public function scopeJoinCanStudyProtocols($query)
    {
        return $query->join('users_has_access_surveys', 'users_has_access_surveys.survey_id', '=', 'protocol.survey_id');
    }

    /****** End Scopes ******/

	public function isValid($data)
    {
        $rules = array(
            'name'     => 'required|max:100|unique:protocol',
            'user_id' => 'required'
        );

        if ($this->exists)
        {
			$rules['name'] .= ',name,'.$this->id.',id';
        }
        else 
        {
            $rules['url_pdf'] = 'required';
        }
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

    public function isValidPDF($pdf)
    {
        if(!is_null($pdf) && !$pdf->isValid())
        {
            $this->errors = array('El campo PDF debe ser menor que '.ini_get('upload_max_filesize'));
            return false;
        }

        return true;
    }

    public function validAndSave($data, $pdf)
    {
        if ($this->uploadPdf($pdf) && $this->isValid($data))
        {
            $this->fill($data);
            if(!$this->exists)
            {
                $survey = Survey::create(array('name' => 'Examen de Protocolo ' + $data['name'], 'created_by' => Auth::user()->id, 'type_id' => 2));
                $this->survey_id = $survey->id;
            }

            $this->save();
            $survey = $this->survey;
            if(array_key_exists('survey_aviable', $data))
            {
                $survey->aviable = true;  
            }
            else
            {
                $survey->aviable = false;    
            }

            $survey->save();
            

            if(array_key_exists('categories', $data))
            {
                $this->syncCategories($data['categories']);
            }

            if(array_key_exists('areas', $data))
            {
                $this->survey->syncAreas($data['areas']);
            }          

            if(array_key_exists('roles', $data))
            {
                $this->survey->syncRoles($data['roles']);
            }
            
            return true;
        }
        
        return false;
    }

    public function syncCategories($categories = array())
    {
        $this->categories()->sync($categories);
    }

    public function uploadPdf($pdf)
    {
        if (File::isFile($pdf))
        {
            if($this->isValidPDF($pdf))
            {
            	$url = Config::get('constant.path_protocols_pdf').'/'.$this->id.'.'.$pdf->getClientOriginalExtension();
                
                $pdf->move(Config::get('constant.path_protocols_pdf'), $this->id.'.'.$pdf->getClientOriginalExtension());
            	$this->url_pdf = $url;

                return true;
            }
        }
        else
        {
            if(!is_null($pdf))
            {
                $this->url_pdf = $pdf;
            }
            return true;
        }

        return false;
    }
}
