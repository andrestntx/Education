<?php
namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\SimpleResourceController;
use Education\Http\Requests\Companies\CreateRequest;
use Education\Http\Requests\Companies\EditRequest;
use Education\Entities\Company;
use Education\Repositories\CompanyRepository;

class CompaniesController extends SimpleResourceController
{
    protected $formWithFiles = true;
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function store(CreateRequest $request, Company $company)
    {
        $this->companyRepository->create($request->all(), $request->file('url_logo'));
        $this->resourceFlash($company->name, 'store');

        return $this->resourceRedirect('index', $company);
    }

    public function show(Company $company)
    {
        return $this->resourceRedirect('edit', $company);
    }

    public function edit(Company $company)
    {
        $formData = $this->getFormData('update', 'PUT', true, $company);

        return $this->getFormView($company, $formData);
    }

    public function update(EditRequest $request, Company $company)
    {
        $this->companyRepository->update($company, $request->all(), $request->file('url_logo'));
        $this->resourceFlash($company->name, 'update');

        return $this->resourceRedirect('index');
    }

    protected function getResourceEntity()
    {
        return Company::class;
    }
}
