<?php

namespace Toernooi\Backend\Controllers;

use Toernooi\Backend\Entity\Toernooi;
use Resources\Backend\Entity\Adres;

class ToernooiController
{
  const ADRES = 'Resources\Backend\Entity\Adres';
  const TOERNOOI = 'Toernooi\Backend\Entity\Toernooi';

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

    $this->toernooiService->persist($this->createToernooi($data));
  }

  public function update($request, $response, $args) {
    $data = $request->getParsedBody();

    foreach($data as $key => $value) {
      if (!isset($data[$key]) || $data[$key] == "")
        return $response->withJson($this->construct_error("Data mag niet null zijn."));
    }

    $toernooi = $this->toernooiService->find(self::TOERNOOI, $data['id']);
    $this->toernooiService->persist($this->createToernooi($data, $toernooi));
  }

  public function delete($request, $response, $args) {
    $data = $request->getParsedBody();

    $toernooi_id = $data['id'];
    if (!isset($toernooi_id))
      return $response->withJson($this->construct_error("Data mag niet null zijn."));

    $this->toernooiService->delete(self::TOERNOOI, $data['id']);
  }

  public function getList($request, $response, $args) {
    $ret_data = array();
    $data = $this->toernooiService->getList(self::TOERNOOI);
    for ($i=0; $i<count($data);$i++) {
      array_push($ret_data, $this->entityToArray($data[$i]));
    }
    return $response->withJson($ret_data);
  }

  public function find($request, $response, $args) {
    $data = $request->getParsedBody();
    $toernooi = $this->toernooiService->find(self::TOERNOOI, $data['id']);
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
      'toernooi_naam' => $entity->toernooinaam,
      'vereniging_naam' => $entity->vereniging_naam,
      'postcode' => $entity->adres->postcode,
      'plaatsnaam' => $entity->adres->plaatsnaam,
      'straatnaam' => $entity->adres->straatnaam,
      'huisnummer' => $entity->adres->huisnummer,
      'start_datum' => $entity->start_datum,
      'eind_datum' => $entity->eind_datum,
      'organisatie' => $entity->organisatie,
      'goedkeuring' => $entity->goedkeuring,
      'toernooitype' => $entity->toernooitype,
      'max_aantal_spelers' => $entity->max_aantal_spelers,
      'team' => $entity->teams
    );
  }

  private function createToernooi($data, $entity = null) {
    $toernooi = $entity == null ? new Toernooi() : $entity;

    $adres = $this->toernooiService
      ->find(self::ADRES, array(
        'postcode' => $data['postcode'],
        'huisnummer' => $data['huisnummer']
      ));

    if ($adres == null) {
      $adres = new Adres();
      $adres->postcode           = $data['postcode'];
      $adres->plaatsnaam         = $data['plaatsnaam'];
      $adres->straatnaam         = $data['straatnaam'];
      $adres->huisnummer         = $data['huisnummer'];
    } else {
      $adres->plaatsnaam         = $data['plaatsnaam'];
      $adres->straatnaam         = $data['straatnaam'];
    }

    $toernooi->toernooinaam       = $data['naam'];
    $toernooi->toernooitype       = $data['type'];
    $toernooi->start_datum        = new \DateTime($data['start_datum'] . ' ' . $data['tijd']);
    $toernooi->eind_datum         = new \DateTime($data['eind_datum']);
    $toernooi->organisatie        = $data['organisatie'];
    $toernooi->vereniging_naam    = 'Vereniging';
    $toernooi->goedkeuring        = 0;
    $toernooi->max_aantal_spelers = $data['max_aantal_spelers'];

    // Foreign key
    $toernooi->adres = $adres;
    $adres->toernooi_collection->add($toernooi);

    return $toernooi;
  }
}

?>
