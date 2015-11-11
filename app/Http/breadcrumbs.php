<?php 

Breadcrumbs::register('home', function($breadcrumbs){
	$breadcrumbs->push('<i class="fa fa-home"></i>', url('/'));
});		

// Home > Companies
Breadcrumbs::register('companies', function($breadcrumbs)
{
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Empresas', route('companies.index'));
});

// Home > Companies > Company
Breadcrumbs::register('companies.company', function($breadcrumbs, $company)
{
	$breadcrumbs->parent('companies');

	if($company->exists)
	{
		$breadcrumbs->push($company->name, route('companies.show', $company->id));
	}
	else
	{
		$breadcrumbs->push('Nueva', route('companies.create'));
	}
});

// Home > Companies > Company > Users
Breadcrumbs::register('companies.company.users', function($breadcrumbs, $company)
{
	$breadcrumbs->parent('companies.company', $company);

	$breadcrumbs->push('Usuarios', route('companies.users.index', $company->id));

});

// Home > Companies > Company > Users > User
Breadcrumbs::register('companies.company.users.user', function($breadcrumbs, $company, $user)
{
	$breadcrumbs->parent('companies.company.users', $company);

	if($user->exists)
	{
		$breadcrumbs->push($user->name, route('companies.users.show', [$company->id, $user->id]));
	}
	else
	{
		$breadcrumbs->push('Nuevo', route('companies.users.create', $company->id));
	}
});

// Home > Areas
Breadcrumbs::register('areas', function($breadcrumbs)
{
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Áreas', route('areas.index'));
});

// Home > Areas > Area
Breadcrumbs::register('areas.area', function($breadcrumbs, $area)
{
	$breadcrumbs->parent('areas');

	if($area->exists)
	{
		$breadcrumbs->push($area->name, route('areas.show', $area->id));
	}
	else
	{
		$breadcrumbs->push('Nueva', route('areas.create'));
	}
});

// Home > Roles
Breadcrumbs::register('roles', function($breadcrumbs)
{
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Perfiles', route('roles.index'));
});

// Home > Roles > Role
Breadcrumbs::register('roles.role', function($breadcrumbs, $role)
{
	$breadcrumbs->parent('roles');

	if($role->exists)
	{
		$breadcrumbs->push($role->name, route('roles.show', $role->id));
	}
	else
	{
		$breadcrumbs->push('Nuevo', route('roles.create'));
	}
});

?>