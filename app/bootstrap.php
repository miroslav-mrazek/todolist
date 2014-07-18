<?php

use Nette\Configurator;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/shortcuts.php';

$configurator = new Configurator;

//$configurator->setDebugMode(TRUE);

$configurator->enableDebugger(__DIR__ . '/../log');
$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->addDirectory(__DIR__ . '/../vendor/others')
	->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon');

$container = $configurator->createContainer();

return $container;