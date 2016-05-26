<?php

namespace Registratie\Backend\Controllers;

use Registratie\Backend\Services;

class AanmeldenController
{
  private $aanmeldenService;
  public function __construct($container) {
    $this->aanmeldenService = $container->AanmeldenService;
  }

  public function addSpelerToToernooi($request, $response, $args) {
    $data = $request->getParsedBody();

    $persoon_id = $data['persoon_id'];
    $toernooi_id = $data['toernooi_id'];
    $team_naam = isset($data['team_naam']) ? $data['team_naam'] : null;
    $partner_id = isset($data['partner_id']) ? $data['partner_id'] : null;

    $this->aanmeldenService->addSpelerToToernooi($persoon_id, $toernooi_id, $team_naam, $partner_id);
  }
}

?>
