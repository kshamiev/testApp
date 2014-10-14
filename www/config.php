<?php
/**
 * The basic configuration of the all application.
 */
return [
    //  system Settings
    'System' => [
        //  The path to the php Interpreter
        'PathPhp' => '/usr/bin/php',
        //  File storage sessions
        'PathSession' => '/var/lib/php5',
    ],
    //  Access for DB (Mysql)
    'Db' => [
        //  Host or Socket
        'Host' => "localhost",
        //  User
        'Login' => "test",
        //  Password
        'Password' => "test",
        //  Name DB
        'Name' => "test",
    ],
    //  site settings
    'Site' => [
        //  General Authorization Application
        'AccessLogin' => '',
        'AccessPassword' => '',
        //  Site name (of the project)
        'Name' => "Test Application",
        //  Email the site (by default)
        'Email' => "konstantin@shamiev.ru",
        //  Timeout online users status
        'UsersTimeoutOnline' => 600,
        //  Using a caching system
        'IsCache' => false,
        //  Parsing the templates view
        'TemplateParsing' => true,
        //  Language of the site by default
        'Language' => "ru-ru",
        //  Domain of the site by default
        'Domain' => 'shamiev.ru',
        //  Static Data Domain Site (css, js, img - design)
        'DomainAssets' => '',
        //  Domain binary data (uploaded by users)
        'DomainUpload' => '',
    ],
    //  The settings of the presentation of data
    'View' => [
        //  Number of items per page
        'PageItem' => "20",
        //  The range of visible pages
        'PageStep' => "11",
    ],
    //  Monitoring
    'Log' => [
        //  Profiling
        'Profile' => [
            //  Fatal errors
            'Error' => true,
            //  Warning
            'Warning' => true,
            //  Notice
            'Notice' => true,
            //  User action
            'Action' => true,
            //  Work the application as a whole
            'Application' => true,
        ],
        //  Output
        'Output' => [
            //  File
            'File' => true,
            //  Display
            'Display' => true,
        ],
    ],
    //  Languages
    'Language' => [
        'en-en' => ['ID' => 1, 'Name' => 'English'],
        'ru-ru' => ['ID' => 2, 'Name' => 'Русский'],
    ],
    //  Servers Memcache
    'Memcache' => [
        //  For Cache data
        'Cache' => [
            //  'localhost:11211'
        ],
        //  Session storage
        'Session' => [
            //  'localhost:11211'
        ],
    ],
];
