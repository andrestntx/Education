<?php

return [
    'names' => [
        \Education\Entities\Protocol::class => 'protocolo',
        \Education\Entities\Company::class => 'institución',
        \Education\Entities\User::class => 'administrador',
        \Education\Entities\Area::class => 'área',
        \Education\Entities\Category::class => 'categoría',
        \Education\Entities\Role::class => 'rol',
        \Education\Entities\User::class => 'usuario',
        \Education\Entities\Math::class => 'fórumla',
        \Education\Entities\Question::class => 'pregunta'
    ],

    'resources' => [
        'store' => ':entity :entity_name creado correctamente',
        'update' => ':entity :entity_name actualizado correctamente',
        'delete' => ':entity :entity_name eliminado correctamente',
        'error-delete' => 'El :entity :entity_name no pudo ser eliminiado'
    ]
];