<?php

namespace Education\Entities;

/**
 * 
 */
class ExamScores extends Model
{
    protected $table = 'exam_scores';
    protected $primaryKey = 'id';

    public function getFormatedScoreAttribute()
    {
        return number_format($this->score, 0);
    }
}
