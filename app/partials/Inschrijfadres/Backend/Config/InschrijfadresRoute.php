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
			$this->get('/list', 'Inschrijfadres\Backend\Controllers\InschrijfadresController:getList');
			$this->post('/delete', 'Inschrijfadres\Backend\Controllers\InschrijfadresController:delete');
			$this->post('/update', 'Inschrijfadres\Backend\Controllers\InschrijfadresController:update');
			$this->post('/find', 'Inschrijfadres\Backend\Controllers\InschrijfadresController:find');
    });
	}
}

?>
