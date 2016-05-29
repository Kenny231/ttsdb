<?php

namespace Wedstrijd\Backend\DependencyInjection;

use Wedstrijd\Backend\Services\WedstrijdService;

class WedstrijdDI
{
	public function __construct($app) {
		$this->setDependencies($app);
	}

	private function setDependencies($app) {
		$container = $app->getContainer();

		$container['WedstrijdService'] = function($container) {
			return new WedstrijdService($container);
		};
	}
}

?>
