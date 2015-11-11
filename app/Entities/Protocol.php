<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use File, Storage;

class Protocol extends Model
{
	protected $fillable = array('name', 'description', 'aviable', 'url_doc');
	public $timestamps = true;
	public $increments = true;
    
    public function getUpdatedAtHummansAttribute()
    {
        Carbon::setLocale('es');
        return ucfirst($this->updated_at->diffForHumans());
    }

    public function getUserValueAttribute()
    {
        return $this->user->name;
    }

    public function getCategoryIdListsAttribute()
    {
        return $this->categories->lists('id')->all();
    }

    public function getAreaIdListsAttribute()
    {
        return $this->areas->lists('id')->all();
    }

    public function getRoleIdListsAttribute()
    {
        return $this->roles->lists('id')->all();
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
        return $this->annexes->count();
    }

    public function getNumberQuestionsAttribute()
    {
        return $this->questions->count();
    }

    /* End Exams */

    /***** Relations *****/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
        return $this->hasMany(Annex::class);
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

    public function getLinksAttribute()
    {
        $links = $this->annexes->filter(function($annex)
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

    public function fillAndClear($data)
    {
        $this->fill($data);
        
        if(array_key_exists('aviable', $data))
        {
            $this->aviable = 1;
        }
        else
        {
            $this->aviable = 0;
        }
    }

    public function syncRelations($data)
    {
        if(array_key_exists('categories', $data))
        {
            $this->categories()->sync($data['categories']);
        }

        if(array_key_exists('areas', $data))
        {
            $this->areas()->sync($data['areas']);
        }          

        if(array_key_exists('roles', $data))
        {
            $this->roles()->sync($data['roles']);
        }
    }

    public function uploadDoc($file)
    {
        if($file)
        {
            $path = '/protocols/' . $this->id . '/doc.pdf';   
            Storage::disk('local')->put($path,  File::get($file));  
            $this->url_doc = $path;

            return true;
        }

        return false;
    }
}
