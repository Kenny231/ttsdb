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
}

?>
