<?php

namespace Toernooi\Backend\Config;

class SubToernooiRoute
{
  public function __construct($app) {
     $this->createRoutes($app);
  }

  private function createRoutes($app) {
    $app->group('/subtoernooi', function() {
      $this->post('/list', 'Toernooi\Backend\Controllers\SubToernooiController:getList');
      $this->post('/update', 'Toernooi\Backend\Controllers\SubToernooiController:update');
      $this->post('/find', 'Toernooi\Backend\Controllers\SubToernooiController:find');
      $this->post('/available', 'Toernooi\Backend\Controllers\SubToernooiController:findAvailableSub');
    });
  }
}

?>
