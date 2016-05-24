<?php

namespace Inschrijfadres\Backend\DependencyInjection;

use Inschrijfadres\Backend\Services\InschrijfadresService;

class InschrijfadresDI
{
	public function __construct($app) {
	   $this->setDependencies($app);
	}

	private function setDependencies($app) {
		$container = $app->getContainer();

		$container['InschrijfadresService'] = function($container) {
			return new InschrijfadresService($container);
		};
	}
}

?>
