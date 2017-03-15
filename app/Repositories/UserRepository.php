<?php
namespace Education\Repositories;

use Education\Entities\Company;
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

    public function createForCompany(Company $company, array $data, $file)
    {
        $user = new User($data);
        $company->users()->save($user);
        $user->syncRelations($data);
        $user->uploadImage($file);

        return $user;
    }

    public function update(User $user, array $data, $file)
    {
        $user->fill($data);
        $user->save();
        $user->syncRelations($data);
        $user->uploadImage($file);

        return $user;
    }
}