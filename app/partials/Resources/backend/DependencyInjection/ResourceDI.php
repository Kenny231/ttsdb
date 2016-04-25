<?php

namespace Resources\Backend\DependencyInjection;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class ResourceDI
{
	public function __construct($app) {
	   $this->setDependencies($app);
	}

	private function setDependencies($app) {
		$container = $app->getContainer();

		$container['em'] = function ($container) {
			$config = Setup::createAnnotationMetadataConfiguration(array("../partials/"), true);
			$conn = array(
			    'dbname' => 'ttsdb',
			    'user' => 'localhost',
			    'password' => 'ise2016',
			    'host' => 'Kenny',
			    'driver' => 'sqlsrv',
			);
			return EntityManager::create($conn, $config);
		};
	}
}

?>
