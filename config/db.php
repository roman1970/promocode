<?php

//var_dump($params_loc); exit;
return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host=".$params_loc['db_host'].";dbname=".$params_loc['db_name'],
    'username' => $params_loc['db_username'],
    'password' => $params_loc['db_password'],
    'charset' => 'utf8',


    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
