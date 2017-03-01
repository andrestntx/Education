<?php
namespace Education\Repositories;

use Education\Entities\Company;

class CompanyRepository extends BaseRepository
{
    public function create(array $data, $logoFile)
    {
        $company = new Company;
        $company->fillAndClear($data);
        $company->save();
        $company->uploadLogo($logoFile);

        return $company;
    }

    public function update(Company $company, array $data, $logoFile)
    {
        $company->fillAndClear($data);
        $company->save();
        $company->uploadLogo($logoFile);

        return $company;
    }
}