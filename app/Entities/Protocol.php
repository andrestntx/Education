<?php

namespace Education\Entities;

use File, Storage;

class Protocol extends MyDocument
{
    protected $fillable = ['name', 'description', 'aviable', 'url_doc'];
    public $timestamps = true;
    public $increments = true;

    public function getUserValueAttribute()
    {
        return $this->user->name;
    }

    public function getCategoryIdListsAttribute()
    {
        return $this->categories->lists('id')->all();
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

    public function links()
    {
        return $this->hasMany(Link::class);
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

    public function syncRelations(array $data = array())
    {
        if (array_key_exists('categories', $data)) {
            $this->categories()->sync($data['categories']);
        }

        $this->syncDefaultRelations($data);
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

    public function detachAndDelete()
    {
        $this->areas()->detach();
        $this->categories()->detach();
        $this->roles()->detach();
        $this->delete(); 
    }
}
