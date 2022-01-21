<?php
if(false === defined('BASEPATH')) {
    define('BASEPATH', realpath(__DIR__ . '/..'));
}

require_once(BASEPATH. '/libs/Config.php');

class db{
protected function connect(){
    $db_config = Config::get('db');
    $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
    $dbUser = "root";
    $dbPass = "";

    $pdo = new PDO($dsn,$dbUser,$dbPass);
    
    
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    return $pdo;
}

}