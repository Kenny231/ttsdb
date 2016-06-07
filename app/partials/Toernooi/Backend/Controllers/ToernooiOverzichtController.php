<?php

namespace Toernooi\Backend\Controllers;



class ToernooiOverzichtController
{

  $toernooiOverzichtService;
  function __construct($container)
  {
    $this->toernooiOverzichtService = $container->ToernooiOverzichtService;
  }

  public function createPoules($request, $response, $args){
      $data = $request->getParsedBody();

      foreach($data as $key => $value) {
        if (!isset($data[$key]) || $data[$key] == "")
          return $response->withJson($this->construct_error("Data mag niet null zijn."));
      }
      $this->toernooiOverzichtService->createPoules($data);

  }



}





 ?>
