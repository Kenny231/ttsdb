<?php

namespace Inschrijfadres\Backend\Config;

class InschrijfadresRoute
{
	public function __construct($app) {
	   $this->createRoutes($app);
	}

	private function createRoutes($app) {
    $app->group('/inschrijfadres', function() {
      $this->post('/add', 'Inschrijfadres\Backend\Controllers\InschrijfadresController:create');

    });
	}
}

?>
