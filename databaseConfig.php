<?php
function getDbConfig(){
    $config = [
        'db_engine' => 'mysql',
        'db_host' => 'localhost',
        'db_name' => 'my_bookingmanager',//'bookingengine',
        'db_user' => 'root',
        'db_password' => '',
    ];
    return $config;
}
?>