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
			$this->get('/list', 'Toernooi\Backend\Controllers\ToernooiController:getList');
			$this->post('/delete', 'Toernooi\Backend\Controllers\ToernooiController:delete');
			$this->post('/update', 'Toernooi\Backend\Controllers\ToernooiController:update');
			$this->post('/find', 'Toernooi\Backend\Controllers\ToernooiController:find');
    });
	}
}

?>
