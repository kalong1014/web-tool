<?php

return [
    'autoload' => false,
    'hooks' => [
        'app_init' => [
            'alioss',
        ],
        'module_init' => [
            'alioss',
        ],
        'upload_config_init' => [
            'alioss',
        ],
        'upload_delete' => [
            'alioss',
        ],
    ],
    'route' => [],
    'priority' => [],
];
