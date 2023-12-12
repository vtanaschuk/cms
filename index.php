<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

use DI\Definition\FileLoader\YamlDefinitionFileLoader;

require_once __DIR__ . '/vendor/autoload.php';

$container = new DI\ContainerBuilder();

$container->addDefinitionsFromFile(new YamlDefinitionFileLoader('app/config/di.yml'));
/** @var \Blog\Service\App $app */
$app = $container->build()->get(\Blog\Service\App::class);
$app->run();
