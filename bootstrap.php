<?php
// bootstrap.php
require_once "vendor/autoload.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;


// Create a simple "default" Doctrine ORM configuration for Attributes
$paths = array(__DIR__ . "/src");
$isDevMode = true;

$config = ORMSetup::createAnnotationMetadataConfiguration($paths, $isDevMode);


// configuring the database connection
$connection = DriverManager::getConnection([
    'dbname' => 'bikestoresab_0',
    'user' => '408981',
    'password' => 'vr@9k!x2nBuT_EC',
    'host' => 'mysql-bikestoresab.alwaysdata.net',
    'driver' => 'pdo_mysql',
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);
