<?php

namespace Toernooi\Backend\Services;

use Toernooi\Backend\Entity\Toernooi;
use Resources\Backend\Service\BaseService;

class ToernooiService extends BaseService
{
  public function addToernooi($data)
  {
    $toernooi = new Toernooi();

    $toernooi->toernooi_naam      = $data['naam'];
    $toernooi->toernooitype       = $data['type'];
    $toernooi->geslacht           = $data['geslacht'];
    $toernooi->enkel              = $data['enkel'];
    $toernooi->start_datum        = $data['start_datum'];
    $toernooi->eind_datum         = $data['eind_datum'];
    $toernooi->organisatie        = $data['organisatie'];
    $toernooi->aanvangstijdstip   = $data['tijd'];
    // Default waardes voor nu
    $toernooi->postcode           = '4325KB';
    $toernooi->vereniging_naam    = 'Vereniging';
  }
}

?>
