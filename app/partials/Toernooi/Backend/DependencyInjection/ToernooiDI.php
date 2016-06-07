<?php

namespace Toernooi\Backend\DependencyInjection;

use Toernooi\Backend\Services\ToernooiService;
use Toernooi\Backend\Services\SubToernooiService;

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
    $container['SubToernooiService'] = function($container) {
      return new SubToernooiService($container);
    };
    $container['ToernooiOverzichtService'] = function($container) {
      return new ToernooiOverzichtService($container);
    };
  }
}

?>
