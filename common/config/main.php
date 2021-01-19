<?php
use kartik\datecontrol\Module;
use kartik\report\Report;
$url_utama = '/scelton/';

return [
    'name'=>'Esindo 1.0',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Jakarta',

    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'MyComponent' => [
            'class' => 'backend\components\MyComponent',

        ], //Buatan sendiri
        
        'DataInduk' => [
            'class' => 'backend\components\DataInduk',
        ], //Buatan sendiri
		
        'KomponenDetil' => [
            'class' => 'backend\components\KomponenDetil',
        ], //Buatan sendiri
        
        //Ini harus dipasang bersamaan dengan`yii2mod/yii2-rbac
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'user'],
        ],
        //Ini harus dipasang bersamaan dengan`yii2mod/yii2-rbac
        'i18n' => [
            'translations' => [
                'yii2mod.rbac' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/rbac/messages',
                ],
                
            ],
        ],

        'formatter' => [
            'class' => 'yii\i18n\Formatter',
                'nullDisplay' => '-', //tampilan field kosong 
                'thousandSeparator' => '.',
                'decimalSeparator' => ',',
                'currencyCode' => ''
        ],
        // setup Krajee Yii2 Report component BELUM JALAN ERROR DARI SONONYA
        'report' => [
            'class' => Report::classname(),
            'apiKey' => 'txsz89sz82szp2acf9kz74fr',
            // the following variables can be set to globally default your settings
            'templateId' => 1, // optional: the numeric identifier for your default global template 
            'outputAction' => Report::ACTION_FORCE_DOWNLOAD, // or Report::ACTION_GET_DOWNLOAD_URL 
            'outputFileType' => Report::OUTPUT_PDF, // or Report::OUTPUT_DOCX
            'outputFileName' => 'KrajeeReport.pdf', // a default file name if 
            'defaultTemplateVariables' => [ // any default data you desire to always default
                'companyName' => 'Krajee.com'
            ],
        ],
        'urlManagerBackendImages' => [
                'class' => 'yii\web\urlManager',
                'baseUrl' => $url_utama.'backend/web/images/', //Harus spt ini jika tidak pada saat gridview, pindah halaman semua image akan hilang
                'enablePrettyUrl' => true,
                'showScriptName' => false,
        ],
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => $url_utama.'backend/web/', 
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManagerIcon' => [
                'class' => 'yii\web\urlManager',
                'baseUrl' => $url_utama.'frontend/web/',
                'enablePrettyUrl' => true,
                'showScriptName' => false,
        ],
        'urlManagerFrontendImage' => [
                'class' => 'yii\web\urlManager',
                'baseUrl' => $url_utama.'frontend/web/img/',
                'enablePrettyUrl' => true,
                'showScriptName' => false,
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => $url_utama,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManagerFrontendWeb' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => $url_utama.'frontend/web/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],

    'modules' => [
        //Ini harus dipasang bersamaan dengan`yii2mod/yii2-rbac (ada 2 kompenen diatas)
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],

        'reportico' => [
            'class' => 'reportico\reportico\Module' ,
            'controllerMap' => [
                            'reportico' => 'reportico\reportico\controllers\ReporticoController',
                            'mode' => 'reportico\reportico\controllers\ModeController',
                            'ajax' => 'reportico\reportico\controllers\AjaxController',
                        ]
            ],
       'gridview' =>  [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],

        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d',
                Module::FORMAT_TIME => 'php:HH:mm:ss',
                Module::FORMAT_DATETIME => 'php:yyyy-m-d HH:mm:ss',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d',
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],

            // set your display timezone
            'displayTimezone' => 'Asia/Jakarta',

            // set your timezone for date saved to db
            'saveTimezone' => 'Asia/Jakarta',

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

            // use ajax conversion for processing dates from display format to save format.
            'ajaxConversion' => true,

            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => [ 'pluginOptions'=>['autoclose'=>true]], // example
                Module::FORMAT_DATETIME => ['php:Y-m-d H:i:s'], // setup if needed
                Module::FORMAT_TIME => [], // setup if needed
            ],

            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => 'php:d-M-Y',
                        'options' => ['class'=>'form-control'],
                    ]
                ]
            ],
            // other settings
        ],
        
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
        // other module settings, refer detailed documentation
        ]
        
    ],    

    
];
