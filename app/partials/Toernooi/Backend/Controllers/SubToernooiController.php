<?php

namespace Toernooi\Backend\Controllers;

class SubToernooiController
{
  const LICENTIE = 'Toernooi\Backend\Entity\Licentie';
  const SUBTOERNOOI = 'Toernooi\Backend\Entity\SubToernooi';
  const LEEFTIJDSCATEGORIE = 'Registratie\Backend\Entity\Leeftijdscategorie';

  private $toernooiService;
  public function __construct($container) {
    $this->toernooiService = $container->SubToernooiService;
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

    $this->toernooiService->createSubToernooi($data);
  }

  public function update($request, $response, $args) {
    $data = $request->getParsedBody();

    foreach($data as $key => $value) {
      if (!isset($data[$key]) || $data[$key] == "")
        return $response->withJson($this->construct_error("Data mag niet null zijn."));
    }

    $toernooi = $this->toernooiService->find(self::SUBTOERNOOI, array(
      'toernooi_id' => $data['toernooi_id'],
      'subtoernooi_id' => $data['subtoernooi_id']
    ));
    $this->toernooiService->persist($this->createSubToernooi($data, $toernooi));
  }

  public function delete($request, $response, $args) {
    $data = $request->getParsedBody();

    $this->toernooiService->delete(self::SUBTOERNOOI, array(
      'toernooi_id' => $data['toernooi_id'],
      'subtoernooi_id' => $data['subtoernooi_id']
    ));
  }

  public function getList($request, $response, $args) {
    $req_data = $request->getParsedBody();
    $ret_data = array();
    $data = $this->toernooiService->getSubToernooiList($req_data['toernooi_id']);
    for ($i=0; $i<count($data);$i++) {
      array_push($ret_data, $this->entityToArray($data[$i]));
    }
    return $response->withJson($ret_data);
  }

  public function find($request, $response, $args) {
    $data = $request->getParsedBody();
    $toernooi = $this->toernooiService->find(self::SUBTOERNOOI, array(
      'toernooi_id' => $data['toernooi_id'],
      'subtoernooi_id' => $data['subtoernooi_id']
    ));
    return $response->withJson($this->entityToArray($toernooi));
  }

  public function findAvailableSub($request, $response, $args) {
    $ret_data = array();
    $data = $request->getParsedBody();
    $toernooi_data = $this->toernooiService->findAvailableSub($data['toernooi_id'], $data['wedstrijd_id']);
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

  private function createSubToernooi($data, $subtoernooi) {
    $subtoernooi->toernooi_id = $data['toernooi_id'];
    $subtoernooi->subtoernooi_id = $data['subtoernooi_id'];
    $subtoernooi->geslacht = $data['geslacht'];
    $subtoernooi->enkel = $data['enkel'];

    $leeftijdscategorie = $this->toernooiService->find(self::LEEFTIJDSCATEGORIE, array(
      'toernooi_id' => $data['toernooi_id'],
      'subtoernooi_id' => $data['subtoernooi_id']
    ));
    $subtoernooi->leeftijdscategorie = $leeftijdscategorie;
    $leeftijdscategorie->subtoernooi = $subtoernooi;
  }
}

?>
