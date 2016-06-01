<?php

namespace Inschrijfadres\Backend\Controllers;

use Inschrijfadres\Backend\Services\InschrijfadresService;

class InschrijfadresController
{
  private $inschrijfadresService;
	public function __construct($container) {
		$this->inschrijfadresService = $container->InschrijfadresService;
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
   $this->inschrijfadresService->addInschrijfadres($data);
  }

  public function update($request, $response, $args) {
    $data = $request->getParsedBody();

    foreach($data as $key => $value) {
      if (!isset($data[$key]) || $data[$key] == "")
        return $response->withJson($this->construct_error("Data mag niet null zijn."));
    }

    $this->inschrijfadresService->updateInschrijfadres($data);
  }

  public function delete($request, $response, $args) {
    $data = $request->getParsedBody();

    $inschrijfadres_id = $data['id'];
    if (!isset($inschrijfadres_id))
      return $response->withJson($this->construct_error("Data mag niet null zijn."));

    $this->inschrijfadresService->deleteInschrijfadres($inschrijfadres_id);
  }

  public function getList($request, $response, $args) {
    $ret_data = array();
    $data = $this->inschrijfadresService->getList();
    for ($i=0; $i<count($data);$i++) {
      array_push($ret_data, $this->entityToArray($data[$i]));
    }
    return $response->withJson($ret_data);
  }

  public function find($request, $response, $args) {
    $data = $request->getParsedBody();
    $inschrijfadres = $this->inschrijfadresService->getById(array('toernooi_id' => $data['toernooi_id'], 'subtoernooi_id' => $data['subtoernooi_id']));
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
}

?>
