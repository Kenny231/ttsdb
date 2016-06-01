<?php

namespace Toernooi\Backend\Controllers;

use Toernooi\Backend\Services\ToernooiService;

class SubToernooiController
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
    $req_data = $request->getParsedBody();
    $ret_data = array();
    $data = $this->toernooiService->getList($req_data['toernooi_id']);
    for ($i=0; $i<count($data);$i++) {
      array_push($ret_data, $this->entityToArray($data[$i]));
    }
    return $response->withJson($ret_data);
  }

  public function find($request, $response, $args) {
    $data = $request->getParsedBody();
    $toernooi = $this->toernooiService->getById(array('toernooi_id' => $data['id'], 'subtoernooi_id' => $data['subtoernooi_id']));
    return $response->withJson($this->entityToArray($toernooi));
  }

  public function findAvailableSub($request, $response, $args) {
    $ret_data = array();
    $data = $request->getParsedBody();
    $toernooi_data = $this->toernooiService->findAvailableSub($data['id'], $data['wedstrijd_id']);
    for ($i=0; $i<count($toernooi_data); $i++)
      array_push($ret_data, $this->entityToArray($toernooi_data[$i]));
    return $response->withJson($ret_data);
  }

  private function entityToArray($entity) {
    return array(
      'toernooi_id' => $entity->toernooi_id,
      'subtoernooi_id' => $entity->subtoernooi_id,
      'categorie_naam' => $entity->categorie_naam,
      'geslacht' => $entity->geslacht,
      'enkel' => $entity->enkel
    );
  }
}

?>
