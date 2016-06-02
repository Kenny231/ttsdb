<?php

namespace Inschrijfadres\Backend\Controllers;

use Resources\Backend\Entity\Adres;
use Inschrijfadres\Backend\Entity\Inschrijfadres;

class InschrijfadresController
{
  const ADRES = 'Resources\Backend\Entity\Adres';
  const WERKNEMER = 'Login\Backend\Entity\Werknemer';
  const SUBTOERNOOI = 'Toernooi\Backend\Entity\SubToernooi';
  const INSCHRIJFADRES = 'Inschrijfadres\Backend\Entity\Inschrijfadres';

  private $baseService;
	public function __construct($container) {
		$this->baseService = $container->BaseService;
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
    $this->baseService->persist($this->createInschrijfadres($data));
  }

  public function update($request, $response, $args) {
    $data = $request->getParsedBody();

    foreach($data as $key => $value) {
      if (!isset($data[$key]) || $data[$key] == "")
        return $response->withJson($this->construct_error("Data mag niet null zijn."));
    }

    $inschrijfadres = $this->baseService->find(self::INSCHRIJFADRES, array(
      'toernooi_id' => $data['toernooi_id'],
      'subtoernooi_id' => $data['subtoernooi_id']
    ));
    $this->baseService->persist($this->createInschrijfadres($data, $inschrijfadres));
  }

  public function delete($request, $response, $args) {
    $data = $request->getParsedBody();

    $this->baseService->delete(self::INSCHRIJFADRES, array(
      'toernooi_id' => $data['toernooi_id'],
      'subtoernooi_id' => $data['subtoernooi_id']
    ));
  }

  public function getList($request, $response, $args) {
    $ret_data = array();
    $data = $this->baseService->getList(self::INSCHRIJFADRES);
    for ($i=0; $i<count($data);$i++) {
      array_push($ret_data, $this->entityToArray($data[$i]));
    }
    return $response->withJson($ret_data);
  }

  public function find($request, $response, $args) {
    $data = $request->getParsedBody();
    $inschrijfadres = $this->baseService
      ->find(self::INSCHRIJFADRES, array(
        'toernooi_id' => $data['toernooi_id'],
        'subtoernooi_id' => $data['subtoernooi_id']
      ));
    return $response->withJson($this->entityToArray($inschrijfadres));
  }

  private function entityToArray($entity) {
    return array(
      'toernooi_id' => $entity->subtoernooi->toernooi_id,
      'subtoernooi_id' => $entity->subtoernooi->subtoernooi_id,
      'postcode' => $entity->adres->postcode,
      'huisnummer' => $entity->adres->huisnummer,
      'plaatsnaam' => $entity->adres->plaatsnaam,
      'straatnaam' => $entity->adres->straatnaam,
      'persoon_id' => $entity->werknemer->persoon_id,
      'telefoonnummer' => $entity->telefoonnummer,
      'email' => $entity->email
    );
  }

  private function createInschrijfadres($data, $entity = null) {
    $inschrijfadres = $entity == null ? new Inschrijfadres() : $entity;

    $adres = $this->baseService
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

    $inschrijfadres->toernooi_id        = $data['toernooi_id'];
    $inschrijfadres->subtoernooi_id     = $data['subtoernooi_id'];
    $inschrijfadres->telefoonnummer     = $data['telefoonnummer'];
    $inschrijfadres->email          	  = $data['email'];

    // Foreign keys
    $werknemer = $this->baseService->find(self::WERKNEMER, $data['persoon_id']);
    $werknemer->inschrijfadres = $inschrijfadres;
    $inschrijfadres->werknemer = $werknemer;

    $subtoernooi = $this->baseService
      ->find(self::SUBTOERNOOI, array(
        'toernooi_id' => $data['toernooi_id'],
        'subtoernooi_id' => $data['subtoernooi_id']
      ));
    $subtoernooi->inschrijfadres = $inschrijfadres;
    $inschrijfadres->subtoernooi = $subtoernooi;

    $inschrijfadres->adres = $adres;
    $adres->inschrijfadres_collection->add($inschrijfadres);

    return $inschrijfadres;
  }
}

?>
