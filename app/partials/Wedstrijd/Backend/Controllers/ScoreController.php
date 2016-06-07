<?php

namespace Wedstrijd\Backend\Controllers;

use Registratie\Backend\Entity\Team;
use Wedstrijd\Backend\Entity\Score;
use Wedstrijd\Backend\Entit\Wedstrijd;

class ScoreController
{
  const TEAM = 'Registratie\Backend\Entity\Team';
  const SCORE = 'Wedstrijd\Backend\Entity\Score';
  const WEDSTRIJD = 'Wedstrijd\Backend\Entity\Wedstrijd';

  private $scoreService;
  public function __construct($container){
    $this->scoreService = $container->ScoreService;
  }

  public function create($request, $response, $args) {
    $data = $request->getParsedBody();

    foreach($data as $key => $value) {
      if (!isset($data[$key]) || $data[$key] == "")
        return $response->withJson($this->construct_error("Data mag niet null zijn."));
    }

    $this->scoreService->addScore($data);
  }

  public function getAmountOfSets($request, $response, $args) {
    $data = $request->getParsedBody();

    return $response->withJson($this->scoreService->getAmountOfSets($data));
  }
}

?>
