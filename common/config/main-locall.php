<?php
return [
    'components' => [
        //untuk tuning performance
        'cache' => [
          //  'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=listing',
            'username' => 'root',
            'password' => 'manutd',
            'charset' => 'utf8',

            //Untuk actionUpload() di Backend/controllers/RawinimpController.php
            //agar bisa upload large csv, baru bisa di lokal, untuk hosting masih blm berhasil
            'attributes' => [ PDO::MYSQL_ATTR_LOCAL_INFILE => true ],
 
            //untuk tuning performance, digunakan untuk view saja, kecuali mau report setiap kebutuhan refresh schema di coding
            //'enableSchemaCache' => true,
            'enableSchemaCache' => false, // <- disable schema cache

            // Duration of schema cache.
            //'schemaCacheDuration' => 3600,

            // Name of the cache component used to store schema information
            //'schemaCache' => 'cache',
            


        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
