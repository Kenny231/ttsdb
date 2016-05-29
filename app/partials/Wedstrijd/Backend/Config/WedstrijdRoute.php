<?php

namespace Wedstrijd\Backend\Config;

class WedstrijdRoute
{
	public function __construct($app) {
		$this->createRoutes($app);
	}
	
	private function createRoutes($app) {
		$app->group('/wedstrijd', function() {
			$this->post('/add', 'Wedstrijd\Backend\Controllers\WedstrijdController:create');
			$this->get('/list', 'Wedstrijd\Backend\Controllers\WedstrijdController:getList');
			$this->post('/delete', 'Wedstrijd\Backend\Controllers\WedstrijdController:delete');
			$this->post('/update', 'Wedstrijd\Backend\Controllers\WedstrijdController:update');
			$this->post('/find', 'Wedstrijd\Backend\Controllers\WedstrijdController:find');
		});
	}
}

?>
