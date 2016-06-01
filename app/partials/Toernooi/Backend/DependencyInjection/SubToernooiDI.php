<?php

namespace Toernooi\Backend\DependencyInjection;

use Toernooi\Backend\Services\SubToernooiService;

class SubToernooiDI
{
  public function __construct($app) {
     $this->setDependencies($app);
  }

  private function setDependencies($app) {
    $container = $app->getContainer();

    $container['SubToernooiService'] = function($container) {
      return new SubToernooiService($container);
    };
  }
}

?>
