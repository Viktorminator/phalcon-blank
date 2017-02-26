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
    'modules' => [
        'frontend' => [
            'dir' => PROJECT_PATH . 'apps/frontend/',
            'className' => 'Apps\Frontend\Module',
            'prefix_router' => false
        ],
        'backend'  => [
            'dir' => PROJECT_PATH . 'apps/backend/',
            'className' => 'Apps\Backend\Module',
            'prefix_router' => 'admin'
        ],
        'api'      => [
            'dir' => PROJECT_PATH . 'apps/api/',
            'className' => 'Apps\Api\Module',
            'prefix_router' => 'api'
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