<?php

namespace Toernooi\Backend\Controllers;



class ToernooiOverzichtController
{

  private $toernooiOverzichtService;

  public function __construct($container)
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

  public function getAllPoules($request, $response, $args){
      $ret_data = array();
      $req_data = $request->getParsedBody();

      $data = $this->toernooiOverzichtService->getAllPoules(
      $req_data['toernooi_id'],
      $req_data['subtoernooi_id']
    );
      for ($i=0; $i<count($data);$i++) {
        array_push($ret_data, $this->entityToArray($data[$i]));
      }
      return $response->withJson($ret_data);
  }


  private function entityToArray($entity) {
    return array(
      'toernooi_id' => $entity->toernooi_id,
      'subtoernooi_id' => $entity->subtoernooi_id,
      'team_id' => $entity->team->team_naam,
      'poule' => $entity->poule,
      'wins' => $entity->wins,
      'position' => $entity->position
    );
  }



}





 ?>
