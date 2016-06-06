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
      $this->post('/available', 'Toernooi\Backend\Controllers\ToernooiController:findAvailable');
    });

    $app->group('/subtoernooi', function() {
      $this->post('/add', 'Toernooi\Backend\Controllers\SubToernooiController:create');
      $this->post('/list', 'Toernooi\Backend\Controllers\SubToernooiController:getList');
      $this->post('/update', 'Toernooi\Backend\Controllers\SubToernooiController:update');
      $this->post('/find', 'Toernooi\Backend\Controllers\SubToernooiController:find');
      $this->post('/available', 'Toernooi\Backend\Controllers\SubToernooiController:findAvailable');
      $this->post('/delete', 'Toernooi\Backend\Controllers\SubToernooiController:delete');
    });
  }
}

?>
