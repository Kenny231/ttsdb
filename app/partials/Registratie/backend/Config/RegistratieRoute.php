<?php

namespace Registratie\Backend\Config;

class RegistratieRoute
{
  public function __construct($app) {
     $this->createRoutes($app);
  }

  private function createRoutes($app) {
    $app->group('/registratie', function() {
      $this->post('/aanmelden', 'Registratie\Backend\Controllers\AanmeldenController:addSpelerToToernooi');
    });
  }
}

?>
