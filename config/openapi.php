<?php

return [

    'collections' => [

        'default' => [

            'info' => [
                'title' => config('app.name'),
                'description' => 'Laravel OpenApi generator demo',
                'version' => '1.0.0',
                'contact' => [],
            ],

            'servers' => [
                [
                    'url' => env('APP_URL'),
                    'description' => 'Local server',
                    'variables' => [],
                ],
            ],

            'tags' => [
                [
                    'name' => 'auth',
                    'description' => 'Authentication',
                ],
                [
                    'name' => 'user',
                    'description' => 'CRUD User',
                ],
                [
                    'name' => 'role',
                    'description' => 'CRUD Role',
                ],
                [
                    'name' => 'siswa',
                    'description' => 'CRUD Siswa',
                ],
                [
                    'name' => 'guru',
                    'description' => 'CRUD Guru',
                ],
                [
                    'name' => 'orang-tua',
                    'description' => 'CRUD Orang Tua',
                ],
                [
                    'name' => 'ruang',
                    'description' => 'CRUD Ruang',
                ]
            ],

            'security' => [
                GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityRequirement::create()->securityScheme('JWT'),
            ],

            // Non standard attributes used by code/doc generation tools can be added here
            'extensions' => [
                // 'x-tagGroups' => [
                //     [
                //         'name' => 'General',
                //         'tags' => [
                //             'user',
                //         ],
                //     ],
                // ],
            ],

            // Route for exposing specification.
            // Leave uri null to disable.
            'route' => [
                'uri' => '/openapi',
                'middleware' => [
                    // App\Http\Middleware\RedirectIfAuthenticated::class,
                ],
            ],

            // Register custom middlewares for different objects.
            'middlewares' => [
                'paths' => [
                    // App\Http\Middleware\Authenticate::class,
                ],
                'components' => [
                    // App\Http\Middleware\Authenticate::class,
                ],
            ],

        ],

    ],

    // Directories to use for locating OpenAPI object definitions.
    'locations' => [
        'callbacks' => [
            app_path('OpenApi/Callbacks'),
        ],

        'request_bodies' => [
            app_path('OpenApi/RequestBodies'),
        ],

        'responses' => [
            app_path('OpenApi/Responses'),
        ],

        'schemas' => [
            app_path('OpenApi/Schemas'),
        ],

        'security_schemes' => [
            app_path('OpenApi/SecuritySchemes'),
        ],
    ],

];
