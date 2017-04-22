<?php
/**
 * Created by Artdevue.
 * User: artdevue - gonfig.php
 * Date: 25.02.17
 * Time: 15:33
 * Project: phalcon-blank
 */

return new \Phalcon\Config([
    'debug' => true,

    'prefix_session' => 'blank_',

    'default_module' => 'frontend',
    'modules'        => [
        'frontend' => [
            'dir'           => PROJECT_PATH . 'apps/frontend/',
            'className'     => 'Apps\Frontend\Module',
            'prefix_router' => false,
            'host_name'     => false
        ],
        'backend'  => [
            'dir'           => PROJECT_PATH . 'apps/backend/',
            'className'     => 'Apps\Backend\Module',
            'prefix_router' => 'admin',
            'host_name'     => false
        ],
        'api'      => [
            'dir'           => PROJECT_PATH . 'apps/api/',
            'className'     => 'Apps\Api\Module',
            'prefix_router' => 'api',
            'host_name'     => false
        ]
    ],

    'name_lang_folder' => 'lang',
    'multilang'        => true,
    'default_lang'     => 'en',
    'languages'        => [
        'en' => [
            'name'                => 'English',
            'default_date_format' => 'F j, Y, g:i a'
        ],
        'ua' => [
            'name'                => 'Український',
            'default_date_format' => 'd-m-Y H:i'
        ]
    ],

    'database' => [
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => '',
        'password' => '',
        'dbname'   => '',
        'charset'  => 'utf8'
    ],

    'application' => [
        'cryptSalt' => 'WtxTUtBpgDSPLJIWdVcOQbdza1G1KLYx',
        'cacheDir'  => PROJECT_PATH . 'cache/',
        'viewsDir'  => PROJECT_PATH . 'apps/commons/views/',
        'errorLog'  => PROJECT_PATH . 'storage/logs/error.log'
    ],

    'base_uri' => 'http://phalcon-blank.com/',

    'site_url'  => 'http://phalcon-blank.com',
    'site_name' => 'Phalcon Blank',

    'email' => '',

    'mail' => [
        'driver'     => 'smtp', // mail, sendmail, smtp
        'host'       => 'smtp.yandex.ua',
        'port'       => 587,
        'from'       => [
            'address' => '',
            'name'    => ''
        ],
        'encryption' => 'tls',
        'username'   => '',
        'password'   => '',
        'sendmail'   => '/usr/sbin/sendmail -bs',
    ],
]);