<?php
return [
    'use_database' => true, // or false

    // Static fallback settings (when DB is off)
    'settings' => [
        'site_name'   => 'Poe Mei',
        'theme_name'  => 'corporate',
        'timezone'    => 'UTC-8',
        'debug'       => true,

        // Database settings if use_database => true
        'db_host'     => 'localhost',
        'db_user'     => 'microcms_poemei',
        'db_pass'     => 'H6a91c62a!',
        'db_name'     => 'microcms_poemei'
    ]
];