<?php

namespace Login\Backend\DependencyInjection;

use Login\Backend\Services\LoginService;

class LoginDI
{
  public function __construct($app) {
     $this->setDependencies($app);
  }

  private function setDependencies($app) {
    $container = $app->getContainer();

    $container['LoginService'] = function($container) {
      return new LoginService($container);
    };
  }
}


 ?>
