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
    //$inschrijfding = $this->inschrijfadresService->addInschrijfadres($data);
  //  return $response->withJson($inschrijfding->postcode);
  }
}

?>
