<?php

namespace Resources\Backend\DependencyInjection;

use Resources\Backend\Service\BaseService;

class BaseServiceDI
{
  public function __construct($app) {
     $this->setDependencies($app);
  }

  private function setDependencies($app) {
    $container = $app->getContainer();

    $container['BaseService'] = function($container) {
      return new BaseService($container);
    };
  }
}

?>
