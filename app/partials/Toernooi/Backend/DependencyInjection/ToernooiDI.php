<?php

namespace Toernooi\Backend\DependencyInjection;

use Toernooi\Backend\Services\ToernooiService;

class ToernooiDI
{
  public function __construct($app) {
     $this->setDependencies($app);
  }

  private function setDependencies($app) {
    $container = $app->getContainer();

    $container['ToernooiService'] = function($container) {
      return new ToernooiService($container);
    };
  }
}

?>
