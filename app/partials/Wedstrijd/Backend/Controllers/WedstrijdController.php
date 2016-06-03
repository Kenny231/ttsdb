<?php

namespace Wedstrijd\Backend\Controllers;

use Wedstrijd\Backend\Entity\Wedstrijd;

class WedstrijdController
{
  const WERKNEMER = 'Login\Backend\Entity\Werknemer';
  const WEDSTRIJD = 'Wedstrijd\Backend\Entity\Wedstrijd';
  const SUBTOERNOOI = 'Toernooi\Backend\Entity\SubToernooi';

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

    $this->wedstrijdService->persist($this->createWedstrijd($data));
  }

  public function update($request, $response, $args) {
    $data = $request->getParsedBody();

    foreach($data as $key => $value) {
      if (!isset($data[$key]) || $data[$key] == "")
      return $response->withJson($this->construct_error("Data mag niet null zijn."));
    }

    $wedstrijd = $this->wedstrijdService->find(self::WEDSTRIJD, array(
      'wedstrijd_id' => $data['wedstrijd_id'],
      'subtoernooi_id' => $data['subtoernooi_id'],
      'toernooi_id' => $data['toernooi_id']
    ));
    $this->wedstrijdService->persist($this->createWedstrijd($data, $wedstrijd));
  }

  public function delete($request, $response, $args) {
    $data = $request->getParsedBody();

    $this->wedstrijdService->delete(self::WEDSTRIJD, array(
      'toernooi_id' => $data['toernooi_id'],
      'subtoernooi_id' => $data['subtoernooi_id'],
      'wedstrijd_id' => $data['wedstrijd_id']
    ));
  }

  public function getList($request, $response, $args) {
    $ret_data = array();
    $req_data = $request->getParsedBody();
    $data = $this->wedstrijdService->getWedstrijdList(
      $req_data['toernooi_id'],
      $req_data['subtoernooi_id']
    );
    for ($i=0; $i<count($data);$i++) {
      array_push($ret_data, $this->entityToArray($data[$i]));
    }
    return $response->withJson($ret_data);
  }

  public function find($request, $response, $args) {
    $data = $request->getParsedBody();
    $wedstrijd = $this->wedstrijdService->find(self::WEDSTRIJD, array(
      'toernooi_id' => $data['toernooi_id'],
      'subtoernooi_id' => $data['subtoernooi_id'],
      'wedstrijd_id' => $data['wedstrijd_id']
    ));
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

  private function createWedstrijd($data, $entity = null) {
    $wedstrijd = $entity == null ? new Wedstrijd() : $entity;

    $wedstrijd->wedstrijd_id        = $data['wedstrijd_id'];
    $wedstrijd->toernooi_id         = $data['toernooi_id'];
    $wedstrijd->subtoernooi_id      = $data['subtoernooi_id'];
    $wedstrijd->team1               = $data['team1'];
    $wedstrijd->team2               = $data['team2'];
    $wedstrijd->start_datum         = new \DateTime($data['start_datum']);
    $wedstrijd->poulecode           = $data['poulecode'];

    $subtoernooi = $this->wedstrijdService->find(self::SUBTOERNOOI, array(
      'toernooi_id' => $data['toernooi_id'],
      'subtoernooi_id' => $data['subtoernooi_id']
    ));
    $wedstrijd->subtoernooi = $subtoernooi;
    $subtoernooi->wedstrijd_collection->add($wedstrijd);

    $werknemer = $this->wedstrijdService->find(self::WERKNEMER, $data['scheidsrechter']);
    $werknemer->wedstrijd = $wedstrijd;
    $wedstrijd->werknemer = $werknemer;

    return $wedstrijd;
  }
}

?>
