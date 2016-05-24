<?php

namespace Inschrijfadres\Backend\Services;

use Inschrijfadres\Backend\Entity\Inschrijfadres;
use Resources\Backend\Service\BaseService;

class InschrijfadresService  extends BaseService
{
  public function addInschrijfadres($data) {
    $em = parent::GetEntityManager();
    $inschrijfadres = $this->createInschrijfadres($data);
   $em->persist($inschrijfadres);
    $em->flush();
    return $inschrijfadres;
  }


  private function createInschrijfadres($data, $entity = null) {
    $inschrijfadres = null;
    if ($entity == null)
      $inschrijfadres = new Inschrijfadres();
    else
      $inschrijfadres = $entity;

    $inschrijfadres->postcode           = $data['postcode'];
    $inschrijfadres->huisnummer         = $data['huisnummer'];
    $inschrijfadres->categorie_naam     = $data['categorie_naam'];
    $inschrijfadres->persoon_id         = $data['persoon_id'];
    $inschrijfadres->telefoonnummer     = $data['telefoonnummer'];
    $inschrijfadres->email          	  = $data['email'];

    return $inschrijfadres;
  }
}

?>
