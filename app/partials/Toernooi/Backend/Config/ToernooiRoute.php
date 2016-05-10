<?php

namespace Toernooi\Backend\Config;

class ToernooiRoute
{
	public function __construct($app) {
	   $this->createRoutes($app);
	}

	private function createRoutes($app) {
    $app->group('/toernooi', function() {
      $this->post('/add', 'Toernooi\Backend\Controllers\ToernooiController:create');
    });
	}
}

?>
