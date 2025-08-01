<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'API de Autenticação para Teste Técnico',
            ],

            'routes' => [
                'api' => 'api/documentation',
            ],
            'paths' => [
                'docs_json' => 'api-docs.json', 
                
                'annotations' => [
                    base_path('app/Http/Controllers/API'),
                    base_path('app/Http/Resources'),
                ],
            ],
        ],
    ],
    'defaults' => [
        'routes' => [
            'docs' => 'docs',
            'oauth2_callback' => 'api/oauth2-callback',
            'middleware' => [
                'api' => [],
                'asset' => [],
                'docs' => [],
                'oauth2_callback' => [],
            ],
            'group_options' => [],
        ],

        'paths' => [
            'docs' => storage_path('api-docs'),
            'views' => base_path('resources/views/vendor/l5-swagger'),
            'base' => env('L5_SWAGGER_BASE_PATH', null),
            'swagger_ui_assets_path' => env('L5_SWAGGER_UI_ASSETS_PATH', 'vendor/swagger-api/swagger-ui/dist/'),
            'excludes' => [],
        ],
        
        // A secção de segurança foi reestruturada para corresponder ao que a view espera.
        'security' => [], // Pode deixar vazio.

        'securityDefinitions' => [
            'securitySchemes' => [], // Adicionar este array vazio é a correção principal.
        ],

        'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', false),
        'generate_on_request' => env('L5_SWAGGER_GENERATE_ON_REQUEST', false),
        'swagger_version' => '3.0',
        'proxy' => false,
        'additional_config' => [],
        'operations_sort' => env('L5_SWAGGER_OPERATIONS_SORT', null),
        'validator_url' => null,
        'additional_config_url' => null,
        'constants' => [
            'L5_SWAGGER_CONST_HOST' => env('L5_SWAGGER_CONST_HOST', 'http://localhost:5252'),
        ],
    ],
];