<?php

use Nette\DI\CompilerExtension;


/**
 * LeanMapper extension for Nette Framework 2.2. Creates 'connection' & 'panel' services.
 *
 * @author     David Grudl, Miroslav Mrázek
 */
class LeanMapperExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$container = $this->getContainerBuilder();
		$config = $this->getConfig();
		barDump($config);

		$useProfiler = isset($config['profiler'])
			? $config['profiler']
			: class_exists('Tracy\Debugger') && $container->parameters['debugMode'];

		unset($config['profiler']);

		if (isset($config['flags'])) {
			$flags = 0;
			foreach ((array) $config['flags'] as $flag) {
				$flags |= constant($flag);
			}
			$config['flags'] = $flags;
		}

		$connection = $container->addDefinition($this->prefix('connection'))
			->setClass('LeanMapper\Connection', array($config));
		
		if(isset($config['entityFactory'])) {
			$container->addDefinition($this->prefix('entityFactory'))
			->setClass($config['entityFactory']);
		}
		
		if(isset($config['mapper'])) {
			$container->addDefinition($this->prefix('mapper'))
			->setClass($config['mapper']);
		}

		if ($useProfiler) {
			$panel = $container->addDefinition($this->prefix('panel'))
				->setClass('Dibi\Bridges\Tracy\Panel');
			$connection->addSetup(array($panel, 'register'), array($connection));
		}
	}

}
