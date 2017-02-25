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
            'path'      => PROJECT_PATH . 'apps/frontend/Module.php'
        ],
        'backend'  => [
            'dir' => PROJECT_PATH . 'apps/backend/',
            'className' => 'Apps\Backend\Module',
            'path'      => PROJECT_PATH . 'apps/backend/Module.php'
        ],
        'api'      => [
            'dir' => PROJECT_PATH . 'apps/api/',
            'className' => 'Apps\Api\Module',
            'path'      => PROJECT_PATH . 'apps/api/Module.php'
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
        'cacheDir'  => __DIR__ . '/../cache/',
        'viewsDir'  => __DIR__ . '/../apps/commons/views/',
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