<?php
namespace Education\Repositories;

use Education\Entities\Protocol;
use Education\Entities\User;

class UserRepository extends BaseRepository
{
    public function usersWithProtocolExams(Protocol $protocol)
    {
        return User::with(array('examScores' => function ($query) use ($protocol) {
            $query->whereSurveyId($protocol->survey_id);

        }, ))->canStudyProtocol($protocol->id)->get();
    }
}