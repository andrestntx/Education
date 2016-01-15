<?php


Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('<i class="fa fa-home"></i>', url('/'));
});

// Home > Companies
Breadcrumbs::register('companies', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Instituciones', route('companies.index'));
});

// Home > Companies > Company
Breadcrumbs::register('companies.company', function ($breadcrumbs, $company) {
    $breadcrumbs->parent('companies');

    if ($company->exists) {
        $breadcrumbs->push($company->name, route('companies.show', $company->id));
    } else {
        $breadcrumbs->push('Nueva', route('companies.create'));
    }
});

// Home > Companies > Company > Users
Breadcrumbs::register('companies.company.users', function ($breadcrumbs, $company) {
    $breadcrumbs->parent('companies.company', $company);

    $breadcrumbs->push('Usuarios', route('companies.users.index', $company->id));

});

// Home > Companies > Company > Users > User
Breadcrumbs::register('companies.company.users.user', function ($breadcrumbs, $company, $user) {
    $breadcrumbs->parent('companies.company.users', $company);

    if ($user->exists) {
        $breadcrumbs->push($user->name, route('companies.users.show', [$company->id, $user->id]));
    } else {
        $breadcrumbs->push('Nuevo', route('companies.users.create', $company->id));
    }
});

// Home > Areas
Breadcrumbs::register('areas', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Áreas', route('areas.index'));
});

// Home > Areas > Area
Breadcrumbs::register('areas.area', function ($breadcrumbs, $area) {
    $breadcrumbs->parent('areas');

    if ($area->exists) {
        $breadcrumbs->push($area->name, route('areas.show', $area->id));
    } else {
        $breadcrumbs->push('Nueva', route('areas.create'));
    }
});

// Home > Maths
Breadcrumbs::register('maths', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Fórmulas', route('maths.index'));
});

// Home > Maths > Math
Breadcrumbs::register('maths.math', function ($breadcrumbs, $math) {
    $breadcrumbs->parent('maths');

    if ($math->exists) {
        $breadcrumbs->push($math->name, route('maths.show', $math->id));
    } else {
        $breadcrumbs->push('Nuevo', route('maths.create'));
    }
});

// Home > Roles
Breadcrumbs::register('roles', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Perfiles', route('roles.index'));
});

// Home > Roles > Role
Breadcrumbs::register('roles.role', function ($breadcrumbs, $role) {
    $breadcrumbs->parent('roles');

    if ($role->exists) {
        $breadcrumbs->push($role->name, route('roles.show', $role->id));
    } else {
        $breadcrumbs->push('Nuevo', route('roles.create'));
    }
});

// Home > Categories
Breadcrumbs::register('categories', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Categoría', route('categories.index'));
});

// Home > Categories > Category
Breadcrumbs::register('categories.category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('categories');

    if ($category->exists) {
        $breadcrumbs->push($category->name, route('categories.show', $category->id));
    } else {
        $breadcrumbs->push('Nuevo', route('categories.create'));
    }
});

// Home > Protocols
Breadcrumbs::register('protocols', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Protocolos', route('protocols.index'));
});

// Home > Protocols > Protocol
Breadcrumbs::register('protocols.protocol', function ($breadcrumbs, $protocol) {
    $breadcrumbs->parent('protocols');

    if ($protocol->exists) {
        $breadcrumbs->push($protocol->name, route('protocols.show', $protocol->id));
    } else {
        $breadcrumbs->push('Nuevo', route('protocols.create'));
    }
});

// Home > Protocols > Protocol > Link
Breadcrumbs::register('protocols.protocol.link', function ($breadcrumbs, $protocol, $link) {
    $breadcrumbs->parent('protocols.protocol', $protocol);

    if ($link->exists) {
        $breadcrumbs->push('Link: '.$link->name, route('protocols.links.show', [$protocol->id, $link->id]));
    } else {
        $breadcrumbs->push('Nuevo Link', route('protocols.links.create', $protocol->id));
    }
});

// Home > Protocols > Protocol > Question
Breadcrumbs::register('protocols.protocol.question', function ($breadcrumbs, $protocol, $question) {
    $breadcrumbs->parent('protocols.protocol', $protocol);

    if ($question->exists) {
        $breadcrumbs->push('Editar Pregunta', route('protocols.questions.show', [$protocol->id, $question->id]));
    } else {
        $breadcrumbs->push('Nueva Pregunta', route('protocols.questions.create', $protocol->id));
    }
});

// Home > Users
Breadcrumbs::register('users', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Usuarios', route('users.index'));
});

// Home > Users > User
Breadcrumbs::register('users.user', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');

    if ($user->exists) {
        $breadcrumbs->push($user->name, route('users.show', $user->id));
    } else {
        $breadcrumbs->push('Nueva', route('users.create'));
    }
});

// Home > Study 
Breadcrumbs::register('study', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Estudiar', route('home'));
});

// Home > Study > Protocol
Breadcrumbs::register('study.protocol', function ($breadcrumbs, $protocol) {
    $breadcrumbs->parent('study');
    $breadcrumbs->push($protocol->name, route('study', $protocol));
});

// Home > Study > Protocol > Exam
Breadcrumbs::register('study.protocol.exam', function ($breadcrumbs, $protocol) {
    $breadcrumbs->parent('study.protocol', $protocol);
    $breadcrumbs->push('Examen', route('exams.store', $protocol));
});

// Home > Study 
Breadcrumbs::register('scores', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Calificaciones', route('home'));
});

// Home > formats
Breadcrumbs::register('formats', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Formatos', url('/formats'));
});

// Home > formats > Checklists
Breadcrumbs::register('formats.checklists', function ($breadcrumbs) {
    $breadcrumbs->parent('formats');
    $breadcrumbs->push('Formatos de Chequeo', route('formats.checklists.index'));
});

// Home > formats > Checklists > format
Breadcrumbs::register('formats.checklists.format', function ($breadcrumbs, $checklistFormat) {
    $breadcrumbs->parent('formats.checklists');

    if ($checklistFormat->exists) {
        $breadcrumbs->push($checklistFormat->name, route('formats.checklists.show', $checklistFormat->id));
    } else {
        $breadcrumbs->push('Nuevo', route('formats.checklists.create'));
    }
});

// Home > Formats > Checklists > Format > Question
Breadcrumbs::register('formats.checklists.format.question', function ($breadcrumbs, $format, $question) {
    $breadcrumbs->parent('formats.checklists.format', $format);

    if ($question->exists) {
        $breadcrumbs->push('Editar Pregunta', route('formats.checklists.questions.show', [$format->id, $question->id]));
    } else {
        $breadcrumbs->push('Nueva Pregunta', route('formats.checklists.questions.create', $format->id));
    }
});

// Home > formats > Observations
Breadcrumbs::register('formats.observations', function ($breadcrumbs) {
    $breadcrumbs->parent('formats');
    $breadcrumbs->push('Observaciones', route('formats.observations.index'));
});

// Home > formats > Observations > format
Breadcrumbs::register('formats.observations.format', function ($breadcrumbs, $observationFormat) {
    $breadcrumbs->parent('formats.observations');

    if ($observationFormat->exists) {
        $breadcrumbs->push($observationFormat->name, route('formats.observations.show', $observationFormat->id));
    } else {
        $breadcrumbs->push('Nuevo', route('formats.observations.create'));
    }
});

// Home > Formats > Observations > Format > Question
Breadcrumbs::register('formats.observations.format.question', function ($breadcrumbs, $format, $question) {
    $breadcrumbs->parent('formats.observations.format', $format);

    if ($question->exists) {
        $breadcrumbs->push('Editar Pregunta', route('formats.observations.questions.show', [$format->id, $question->id]));
    } else {
        $breadcrumbs->push('Nueva Pregunta', route('formats.observations.questions.create', $format->id));
    }
});

// Home > My Formats 
Breadcrumbs::register('myformats', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Mis formatos', '/myformats');
});

// Home > My Formats > Checklists
Breadcrumbs::register('myformats.checklists', function ($breadcrumbs) {
    $breadcrumbs->parent('myformats');
    $breadcrumbs->push('Listas de chequeo', route('myformats.checklists'));
});

// Home > My Formats > Checklists > Doit
Breadcrumbs::register('myformats.checklists.doit', function ($breadcrumbs, $format) {
    $breadcrumbs->parent('myformats.checklists');
    $breadcrumbs->push($format->name, route('myformats.checklists.doit.index', $format));
});

// Home > My Formats > Checklists > Doit > Apply
Breadcrumbs::register('myformats.checklists.doit.apply', function ($breadcrumbs, $format) {
    $breadcrumbs->parent('myformats.checklists.doit', $format);
    $breadcrumbs->push('Aplicar', route('myformats.checklists.doit.create', $format));
});

// Home > My Formats > Observations
Breadcrumbs::register('myformats.observations', function ($breadcrumbs) {
    $breadcrumbs->parent('myformats');
    $breadcrumbs->push('Observaciones', route('myformats.observations'));
});

// Home > My Formats > Observations > Doit
Breadcrumbs::register('myformats.observations.doit', function ($breadcrumbs, $format) {
    $breadcrumbs->parent('myformats.observations');
    $breadcrumbs->push($format->name, route('myformats.observations.doit.index', $format));
});

// Home > My Formats > Observations > Doit > Apply
Breadcrumbs::register('myformats.observations.doit.apply', function ($breadcrumbs, $format) {
    $breadcrumbs->parent('myformats.observations.doit', $format);
    $breadcrumbs->push('Aplicar', route('myformats.observations.doit.create', $format));
});

// Home > My Generated Protocols 
Breadcrumbs::register('generated-protocols', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Protocolos Generados', route('generated-protocols.index'));
});

// Home > My Generated Protocols > Protocol
Breadcrumbs::register('generated-protocols.protocol', function ($breadcrumbs, $protocol) {
    $breadcrumbs->parent('generated-protocols');

    if ($protocol->exists) {
        $breadcrumbs->push('Editar Protocolo', route('generated-protocols.edit', $protocol->id));
    } else {
        $breadcrumbs->push('Generar Protocolo', route('generated-protocols.create'));
    }
});


