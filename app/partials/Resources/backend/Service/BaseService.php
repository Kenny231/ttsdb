<?php

namespace Resources\Backend\Service;

class BaseService
{
  private $em;
  public function __construct($container) {
    $this->em = $container->em;
  }

  protected function GetEntityManager() {
    return $this->em;
  }
}

?>
