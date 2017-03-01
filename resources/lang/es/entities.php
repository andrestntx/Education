<?php

return [
    'names' => [
        \Education\Entities\Protocol::class => 'protocolo',
        \Education\Entities\Company::class => 'institución'
    ],

    'resources' => [
        'store' => ':entity :entity_name creado correctamente',
        'update' => ':entity :entity_name actualizado correctamente',
        'delete' => ':entity :entity_name eliminado correctamente',
        'error-delete' => 'El :entity :entity_name no pudo ser eliminiado'
    ]
];