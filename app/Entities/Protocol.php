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

    public function isAviable()
    {
        if($this->aviable)
        {
            return true;
        }

        return false;
    }

    public function getStateAttribute()
    {
        if($this->aviable)
        {
            return 'Disponible';
        }

        return 'No Disponible';
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

    public function isDocCorrect()
    {
        if(!is_null($this->url_doc))
        {
            return true;
        }

        return false;
    }

    public function getDocAttribute()
    {
        if($this->isDocCorrect())
        {
            return $this->url_doc;
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

    public function getNumberAttribute()
    {
        return count($this->getAnnexes());
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

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function getAnnexes()
    {
        return Storage::files('protocols/' . $this->id . '/annexes');
    }

    public function getUserExams($user)
    {
        $exams = $this->exams->where('user_id', $user->id);
    }

    public function getUserExamsCountAttribute($user)
    {
        return $this->getUserExams()->count();
    }

    public function getUserBestExam($user)
    {
        return $this->getUserExams($user)->orderByDesc('score')->first();
    }

    public function getUserLastExam($user)
    {
        return $this->getUserExams($user)->orderByDesc('created_at')->first();
    }

    public function isExamPending($user)
    {
        return $this->getUserLastExam($user)->isPending();
    }

    public function randomQuestions()
    {
        if($this->questions->count() >= 10)
        {
            return $this->questions->random(10);
        }

        return $this->questions;
    }

    /***** End Relations *****/


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
            $path = 'protocols/' . $this->id . '/doc.pdf';   
            Storage::disk('local')->put($path,  File::get($file));  
            $this->url_doc = '/storage/' . $path;

            return true;
        }

        return false;
    }
}
