<?php
//KITE frontend config

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$url_htaccess = '/listing'; //disesuaikan dengan .htaccess
return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'homeUrl' => $url_htaccess, 

    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => $url_htaccess,                 
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            //'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true], //sengaja agar front dan backend logout sama
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            //'name' => 'advanced-frontend',
            'name' => 'advanced-backend', //sengaja agar front dan back sama saja loginnya
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'MyComponent' => [
            'class' => 'backend\components\MyComponent',
        ], 
        'urlManager' => [
            'baseUrl' => $url_htaccess,                
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                    //Agar url address lebih pretty
                
                    //Jika tidak pakai, contoh; localhost/kite/site
                    //jika pakai, contoh; localhost/kite/

                     //Jika tidak pakai, contoh; localhost/kite/site/about
                    //jika pakai, contoh; localhost/kite/about
                   '' => 'site/index',
                    'about' => 'site/about',
                    'contact' => 'site/contact',
                    'signup '=> 'site/index/signup',
                    'login '=> 'site/index/login',
 
            ],
        ],
        
    ],
    'params' => $params,
];
