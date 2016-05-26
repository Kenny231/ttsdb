<?php

namespace Registratie\Backend\DependencyInjection;

use Registratie\Backend\Services\AanmeldenService;

class RegistratieDI
{
  public function __construct($app) {
     $this->setDependencies($app);
  }

  private function setDependencies($app) {
    $container = $app->getContainer();

    $container['AanmeldenService'] = function($container) {
      return new aanmeldenService($container);
    };
  }
}

?>
