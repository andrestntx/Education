<?php

/*
 * This file is part of Laravel Vimeo.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Vimeo Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'client_id'     => 'b5398ac9572c13067b4de1ebd6fbc5f938cca1a4',
            'client_secret' => 'PfKLDdh7epL3xZTy1N6O7xNP4lHAfN8Nk79IOj8/Ai4Eth2iCqMF+hepMZxQBAMzLZ8p/wBYZ33NdPkcDMPo6FH//NBD+MnJdJQR5hPQzXOXRI9ZRfLhGxs05zthrvUl',
            'access_token'  => '6bd731bdbb0654010d5f94bd3ebf6755',
        ],

        'alternative' => [
            'client_id' => 'your-client-id',
            'client_secret' => 'your-client-secret',
            'access_token' => null,
        ],

    ],

];
