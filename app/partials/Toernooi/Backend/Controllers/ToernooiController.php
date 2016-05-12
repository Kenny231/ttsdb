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
      $row = $data[$i];
      array_push($ret_data, array(
        'toernooi_id' => $row->toernooi_id,
        'toernooi_naam' => $row->toernooi_naam,
        'vereniging_naam' => $row->vereniging_naam,
        'postcode' => $row->postcode,
        'start_datum' => $row->start_datum,
        'eind_datum' => $row->eind_datum,
        'organisatie' => $row->organisatie,
        'goedkeuring' => $row->goedkeuring,
        'toernooitype' => $row->toernooitype,
        'geslacht' => $row->geslacht,
        'enkel' => $row->enkel
      ));
    }
    return $response->withJson($ret_data);
  }
}

?>
