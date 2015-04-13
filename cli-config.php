<?php

require 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$path = array('src/App/Entity');
$isDevMode = true;

$config = Setup::createAnnotationMetadataConfiguration($path, $isDevMode);

$appConfig = require_once __DIR__ . '/config/config.php';
$connectionOptions = $appConfig['db'];

$entityManager = EntityManager::create($connectionOptions, $config);

return ConsoleRunner::createHelperSet($entityManager);