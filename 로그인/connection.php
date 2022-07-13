<?php
$DB_host = "127.0.0.1";
$DB_user = "datagrip";
$DB_password = "63254088";
$DB_database = "login_app";

try {
    $db = new PDO("mysql:host={$DB_host}; dbname={$DB_database}", $DB_user, $DB_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e){
    echo $e ->getMessage();
}