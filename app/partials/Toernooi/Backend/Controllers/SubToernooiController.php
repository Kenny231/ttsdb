<?php

namespace Toernooi\Backend\Controllers;

use Toernooi\Backend\Entity\Licentie;

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

  private function deleteLicenties($licenties) {
    foreach ($licenties as $key => $val) {
      $this->toernooiService->delete(self::LICENTIE, array(
        'licentie' => $val->licentie,
        'toernooi_id' => $val->toernooi_id,
        'subtoernooi_id' => $val->subtoernooi_id,
      ));
    }
  }

  public function update($request, $response, $args) {
    $data = $request->getParsedBody();

    foreach($data as $key => $value) {
      if (!isset($data[$key]) || $data[$key] == "")
        return $response->withJson($this->construct_error("Data mag niet null zijn. " . $key));
    }

    $toernooi = $this->toernooiService->find(self::SUBTOERNOOI, array(
      'toernooi_id' => $data['toernooi_id'],
      'subtoernooi_id' => $data['subtoernooi_id']
    ));

    $licenties = $toernooi->licentie_collection->toArray();
    $this->deleteLicenties($licenties);

    $this->toernooiService->persist($this->createSubToernooi($data, $toernooi));
  }

  public function delete($request, $response, $args) {
    $data = $request->getParsedBody();

    $id = array(
      'toernooi_id' => $data['toernooi_id'],
      'subtoernooi_id' => $data['subtoernooi_id']
    );
    $toernooi = $this->toernooiService->find(self::SUBTOERNOOI, $id);

    $licenties = $toernooi->licentie_collection->toArray();
    $this->deleteLicenties($licenties);
    $this->toernooiService->delete(self::SUBTOERNOOI, $id);
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

  public function findAvailable($request, $response, $args) {
    $ret_data = array();
    $data = $request->getParsedBody();
    $toernooi_data = $this->toernooiService->findAvailable($data['toernooi_id'], $data['persoon_id']);
    for ($i=0; $i<count($toernooi_data); $i++)
      array_push($ret_data, $this->entityToArray($toernooi_data[$i]));
    return $response->withJson($ret_data);
  }

  private function entityToArray($entity) {
    $licenties = array();
    foreach ($entity->licentie_collection->toArray() as $key => $val) {
      array_push($licenties, $val->licentie);
    }
    return array(
      'toernooi_id' => $entity->toernooi_id,
      'subtoernooi_id' => $entity->subtoernooi_id,
      'categorie_naam' => $entity->categorie_naam,
      'geslacht' => $entity->geslacht,
      'enkel' => $entity->enkel,
      'licenties' => $licenties
    );
  }

  private function createSubToernooi($data, $subtoernooi) {
    $subtoernooi->toernooi_id = $data['toernooi_id'];
    $subtoernooi->subtoernooi_id = $data['subtoernooi_id'];
    $subtoernooi->geslacht = $data['geslacht'];
    $subtoernooi->enkel = $data['enkel'];

    $leeftijdscategorie = $this->toernooiService->find(self::LEEFTIJDSCATEGORIE, $data['categorie_naam']);
    $subtoernooi->leeftijdscategorie = $leeftijdscategorie;
    $leeftijdscategorie->subtoernooi = $subtoernooi;

    foreach ($data['licenties'] as $key => $val) {
      $licentie = new Licentie();
      $licentie->toernooi_id = $data['toernooi_id'];
      $licentie->subtoernooi_id = $data['subtoernooi_id'];
      $licentie->licentie = $val;

      $subtoernooi->licentie_collection->add($licentie);
      $licentie->subtoernooi = $subtoernooi;
    }

    return $subtoernooi;
  }
}

?>
