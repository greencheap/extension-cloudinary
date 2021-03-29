<?php
return [
    'name' => 'cloudinary',

    'config' => [
        'cloud_name' => "",
        'api_key' => "",
    ],

    'settings' => 'cloudinary-settings',

    'events' => [
        'view.scripts' => function ($event, $scripts) {
            $scripts->register('cloudinary-settings', 'cloudinary:app/bundle/cloudinary-settings.js', ['~extensions', 'input-tree']);
            $scripts->register('cloudinary-library', 'https://media-library.cloudinary.com/global/all.js', ['~multi-finder']);
            $scripts->register('cloudinary-finder', 'cloudinary:app/bundle/cloudinary-finder.js', ['~multi-finder', 'cloudinary-library']);
            $scripts->register('cloudinary-data', sprintf(
                'var $cloudinary = %s;',
                json_encode($this->config)
            ), ['~multi-finder', 'cloudinary-finder'], 'string');
        }
    ]
];
