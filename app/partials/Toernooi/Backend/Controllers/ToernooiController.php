<?php

namespace Toernooi\Backend\Controllers;

use Toernooi\Backend\Services\ToernooiService;

class ToernooiController
{
  private $toernooiService;
  public function __construct($container) {
    $this->toernooiService = $container->ToernooiService;
  }

  private function construct_error($error_msg) {
    return array(
      'error' => $error_msg
    );
  }

  public function create($request, $response, $args) {
    $data = $request->getParsedBody();

    foreach($data as $key => $value) {
      if (!isset($data[$key]) || $data[$key] == "")
        return $response->withJson($this->construct_error("Data mag niet null zijn."));
    }

    $this->toernooiService->addToernooi($data);
  }

  public function update($request, $response, $args) {
    $data = $request->getParsedBody();

    foreach($data as $key => $value) {
      if (!isset($data[$key]) || $data[$key] == "")
        return $response->withJson($this->construct_error("Data mag niet null zijn."));
    }

    $this->toernooiService->updateToernooi($data);

    return $response->withJson("Toernooi id: " . $data['id']);
  }

  public function delete($request, $response, $args) {
    $data = $request->getParsedBody();

    $toernooi_id = $data['id'];
    if (!isset($toernooi_id))
      return $response->withJson($this->construct_error("Data mag niet null zijn."));

    $this->toernooiService->deleteToernooi($toernooi_id);
  }

  public function getList($request, $response, $args) {
    $ret_data = array();
    $data = $this->toernooiService->getList();
    for ($i=0; $i<count($data);$i++) {
      array_push($ret_data, $this->entityToArray($data[$i]));
    }
    return $response->withJson($ret_data);
  }

  public function find($request, $response, $args) {
    $data = $request->getParsedBody();
    $toernooi = $this->toernooiService->getById($data['id']);
    return $response->withJson($this->entityToArray($toernooi));
  }

  public function findAvailable($request, $response, $args) {
    $ret_data = array();
    $data = $request->getParsedBody();
    $toernooi_data = $this->toernooiService->findAvailable($data['id']);
    for ($i=0; $i<count($toernooi_data); $i++)
      array_push($ret_data, $this->entityToArray($toernooi_data[$i]));
    return $response->withJson($ret_data);
  }

  private function entityToArray($entity) {
    return array(
      'toernooi_id' => $entity->toernooi_id,
      'toernooi_naam' => $entity->toernooi_naam,
      'vereniging_naam' => $entity->vereniging_naam,
      'postcode' => $entity->adres->id,
      'plaatsnaam' => $entity->adres->plaatsnaam,
      'straatnaam' => $entity->adres->straatnaam,
      'huisnummer' => $entity->adres->huisnummer,
      'start_datum' => $entity->start_datum,
      'eind_datum' => $entity->eind_datum,
      'organisatie' => $entity->organisatie,
      'goedkeuring' => $entity->goedkeuring,
      'toernooitype' => $entity->toernooitype,
      'team' => $entity->teams
    );
  }
}

?>
