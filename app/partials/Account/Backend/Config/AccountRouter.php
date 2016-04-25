<?php

namespace Account\Backend\Config;

class AccountRouter
{
	public function __construct($app) {
	   $this->createRoutes($app);
	}

	private function createRoutes($app) {
		$app->post('/login', 'Account\Backend\Controller\AccountController:login');
	}
}

?>
