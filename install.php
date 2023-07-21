<?php
use Library\Pdo\Database\Mysql;

checkForComposer();

checkForDbConfig();

$dbConnection = checkForDbConnection();

createDb($dbConnection);

createTables($dbConnection);

removeInstallationFiles();


function checkForDbConfig():bool|Exception
{
    if (!file_exists(__DIR__ . '/config/config.ini.php')) {
        throw new Exception('config/config.ini.php não existe!');
    }

    $dbConstants = [
        "DB_DRIVER" => DB_DRIVER,
        "DB_SERVER" => DB_SERVER,
        "DB_USER" => DB_USER,
        "DB_PASSWORD" => DB_PASSWORD,
    ];

    foreach($dbConstants as $name => $value) {
        if ($value == "") {
            throw new Exception('Constante ' . $name . ' não definida!');
        }
    }
    
    return true;
}

function checkForComposer():bool|Exception
{
    if (!file_exists(__DIR__ . '/vendor/composer/installed.json')) {
        throw new Exception('É necessário executar o comando: composer install');
    }

    require_once("vendor/autoload.php");
    return true;
}

function checkForDbConnection():PDO|Exception
{
    $connection = new Mysql(DB_SERVER, null, DB_USER, DB_PASSWORD);
    try {
        return $connection->getConn();
    } catch (PDOException $e) {
        throw new Exception($e->getMessage());
    }
}

function createDb($conn):PDOStatement|Exception
{
    try {
        return $conn->query("DROP DATABASE IF EXISTS " . DB_NAME . "; CREATE DATABASE IF NOT EXISTS " . DB_NAME . ";");
    } catch (PDOException $e) {
        throw new Exception($e->getMessage());
    }
}

function createTables($conn):int|Exception
{
    $query = "USE " . DB_NAME . "; ";
    $resource = fopen(__DIR__ . '/var/db/mysql_tables/structure.sql', 'r');

    while (!feof($resource)) {
        $query .= fgets($resource);
    }

    fclose($resource);

    try {
        return $conn->exec($query);
    } catch (PDOException $e) {
        throw new Exception($e->getMessage());
    }
}

function removeInstallationFiles():void
{
    echo "To start the app run: composer server" . PHP_EOL;
    array_map('unlink', glob(__DIR__ . '/var/db/mysql_tables/*.sql'));
    rmdir(__DIR__ . '/var/db/mysql_tables');
    unlink('install.php');
}