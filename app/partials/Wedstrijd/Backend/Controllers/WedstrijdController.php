<?php

namespace Wedstrijd\Backend\Controllers;

use Wedstrijd\Backend\Services\WedstrijdService;

class WedstrijdController
{
  private $wedstrijdService;
  public function __construct($container) {
    $this->wedstrijdService = $container->WedstrijdService;
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
    $this->wedstrijdService->addWedstrijd($data);
  }

  public function update($request, $response, $args) {
    $data = $request->getParsedBody();

    foreach($data as $key => $value) {
      if (!isset($data[$key]) || $data[$key] == "")
      return $response->withJson($this->construct_error("Data mag niet null zijn."));
    }

    $this->wedstrijdService->updateWedstrijd($data);
    return $response->withJson("Wedstrijd id: " . $data['wedstrijd_id']);
  }

  public function delete($request, $response, $args) {
    $data = $request->getParsedBody();

    $wedstrijd_id = $data['wedstrijd_id'];
    $subtoernooi_id = $data['subtoernooi_id'];
    $toernooi_id = $data['toernooi_id'];

    if (!isset($wedstrijd_id)||!isset($subtoernooi_id)||!isset($toernooi_id))
    return $response->withJson($this->construct_error("Data mag niet null zijn."));

    $this->wedstrijdService->deleteWedstrijd($wedstrijd_id, $subtoernooi_id, $toernooi_id);
  }

  public function getList($request, $response, $args) {
    $ret_data = array();
    $data = $this->wedstrijdService->getList();
    for ($i=0; $i<count($data);$i++) {
      array_push($ret_data, $this->entityToArray($data[$i]));
    }
    return $response->withJson($ret_data);
  }

  public function find($request, $response, $args) {
    $data = $request->getParsedBody();

    $wedstrijd_id = $data['wedstrijd_id'];
    $subtoernooi_id = $data['subtoernooi_id'];
    $toernooi_id = $data['toernooi_id'];

    $wedstrijd = $this->wedstrijdService->getById($wedstrijd_id, $subtoernooi_id, $toernooi_id);
    return $response->withJson($this->entityToArray($wedstrijd));
  }

  private function entityToArray($entity) {
    return array(
      'wedstrijd_id' => $entity->wedstrijd_id,
      'subtoernooi_id' => $entity->subtoernooi_id,
      'toernooi_id' => $entity->toernooi_id,
      'team1' => $entity->team1,
      'team2' => $entity->team2,
      'scheidsrechter' => $entity->scheidsrechter,
      'start_datum' => $entity->start_datum,
      'poulecode' => $entity->poulecode
    );
  }



}

?>
