<?php

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use File;
use Storage;

class Protocol extends Model
{
    protected $fillable = ['name', 'description', 'aviable', 'url_doc'];
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
        if ($this->aviable) {
            return true;
        }

        return false;
    }

    public function getStateAttribute()
    {
        if ($this->aviable) {
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

        if (!is_null($examScore)) {
            return $examScore;
        }

        return;
    }

    public function isDocCorrect()
    {
        if (!is_null($this->url_doc)) {
            return true;
        }

        return false;
    }

    public function getDocAttribute()
    {
        if ($this->isDocCorrect()) {
            return $this->url_doc;
        }

        return '#';
    }

    public function getNumberQuestionsAttribute()
    {
        return $this->questions->count();
    }

    public function getNumberAnnexesAttribute()
    {
        return count($this->getAnnexes());
    }

    public function getNumberLinksAttribute()
    {
        return $this->links->count();
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
        return $this->morphToMany(Role::class, 'allowed_roles');
    }

    public function areas()
    {
        return $this->morphToMany(Area::class, 'allowed_areas');
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function questions()
    {
        return $this->morphMany(Question::class, 'document');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function getPathAnnexes()
    {
        return 'protocols/'.$this->id.'/annexes/';
    }

    public function getAnnexes()
    {
        return Storage::files($this->getPathAnnexes());
    }

    public function getUserExams($user)
    {
        return $this->exams->where('user_id', $user->id);
    }

    public function getUserExamsCount($user)
    {
        return $this->getUserExams($user)->count();
    }

    public function getUserBestExam($user)
    {
        return $this->getUserExams($user)->sortByDesc('score')->first();
    }

    public function getUserLastExam($user)
    {
        $exam = $this->getUserExams($user)->sortByDesc('created_at')->first();

        if ($exam) {
            return $exam;
        }
    }

    public function isExamPending($user)
    {
        if (!$this->getUserLastExam($user) || $this->getUserLastExam($user)->isPending()) {
            return true;
        }

        return false;
    }

    public function randomQuestions()
    {
        if ($this->questions->count() >= env('APP_MAX_QUESTION_EXAM')) {
            return $this->questions->random(env('APP_MAX_QUESTION_EXAM'));
        }

        return $this->questions;
    }

    /***** End Relations *****/

    public function fillAndClear($data)
    {
        $this->fill($data);

        if (array_key_exists('aviable', $data)) {
            $this->aviable = 1;
        } else {
            $this->aviable = 0;
        }
    }

    public function syncRelations($data)
    {
        if (array_key_exists('categories', $data)) {
            $this->categories()->sync($data['categories']);
        }

        if (array_key_exists('areas', $data)) {
            $this->areas()->sync($data['areas']);
        }

        if (array_key_exists('roles', $data)) {
            $this->roles()->sync($data['roles']);
        }
    }

    public function uploadDoc($file)
    {
        if ($file) {
            $path = 'protocols/'.$this->id.'/doc.pdf';
            Storage::disk('local')->put($path,  File::get($file));
            $this->url_doc = '/storage/'.$path;

            return true;
        }

        return false;
    }
}
