<?php

namespace Login\Backend\Config;

class LoginRouter
{

  public function __construct($app)
  {
    $this->createRoutes($app);
  }


  private function createRoutes($app){
    $app->post('/login','Login\Backend\Controllers\LoginController:login');
  }
}








 ?>
