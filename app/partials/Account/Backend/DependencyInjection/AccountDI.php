<?php

namespace Account\Backend\DependencyInjection;

use Account\Backend\Service\AccountService;

class AccountDI
{
	public function __construct($app) {
	   $this->setDependencies($app);
	}

	private function setDependencies($app) {
		$container = $app->getContainer();

		$container['AccountService'] = function($container) {
			return new AccountService($container);
		};
	}
}

?>
