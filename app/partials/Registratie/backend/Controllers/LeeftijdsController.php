<?php

namespace Registratie\Backend\Controllers;

class LeeftijdsController
{
  const LEEFTIJDSCATEGORIE = 'Registratie\Backend\Entity\Leeftijdscategorie';

  private $baseService;
  public function __construct($container) {
    $this->baseService = $container->BaseService;
  }

  public function getList($request, $response, $args) {
    $ret_data = array();
    $data = $this->baseService->getList(self::LEEFTIJDSCATEGORIE);
    for ($i=0; $i<count($data); $i++) {
      array_push($ret_data, $data[$i]->categorie_naam);
    }
    return $response->withJson($ret_data);
  }
}

?>
