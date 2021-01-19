<?php
//backend config

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$url_backend = '/listing/admin'; //jika online kosongkan saja cukup /admin
$prettyUrl = array ('0'=>'site/index','1'=>'/prioritas');
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'homeUrl' => $url_backend, 
    'modules' => [

        'mdata' => [
            'class' => 'backend\modules\mdata\Module',
        ],

         'laporan' => [
            'class' => 'backend\modules\laporan\Module',
        ],

    ],
    'components' => [
        'request' => [
            'baseUrl' => $url_backend,        
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
           // 'rules' => [
                    //Agar url address lebih pretty
                
                    //Jika tidak pakai, contoh; http://localhost/kite/superadmin/site/index
                    //jika pakai, contoh; http://localhost/kite/superadmin/site           
                 //   'beranda' => 'site/index',                
       
           // ],
            'rules' => $prettyUrl,
        ],

        'assetManager' => [
            'bundles' => [
            'dmstr\web\AdminLteAsset' => [
                'skin' => 'skin-purple-light',
                // skin-blue,
                // skin-black,
                // skin-red,
                // skin-yellow,
                // skin-purple,
                // skin-green,
                // skin-blue-light,
                // skin-black-light,
                // skin-red-light,
                // skin-yellow-light,
                // skin-purple-light,
                // skin-green-light,

                ],
            ],
        ],
  
        
    ],
    
    //Ini akan membuat semua forbidden, jadi dipasang setelah kebutuhan RBAC sudah benar
    //Definiskan route spt allowaction dibawah dan beri assign Superadmin untuk semua itu
    'as access' => [
        'class' => yii2mod\rbac\filters\AccessControl::class,
        'allowActions' => [
            'site/*', 
            'kunci/*',
            'profil/*',
            //Jika sudah disini maka tidak perlu diassign melalui database
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
            ]
        ],
    'params' => $params,
];
