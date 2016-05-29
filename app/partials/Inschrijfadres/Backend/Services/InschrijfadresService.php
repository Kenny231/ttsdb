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
  }

  public function updateInschrijfadres($data) {
    $em = parent::GetEntityManager($data);
    $inschrijfadres = $this->createInschrijfadres($data, $this->getById($data['id']));
    $em->persist($inschrijfadres);
    $em->flush();
  }

  public function deleteInschrijfadres($id) {
    $em = parent::GetEntityManager();
    $inschrijfadres = $em->getReference(Inschrijfadres::class, $id);
    $em->remove($inschrijfadres);
    $em->flush();
  }

  public function getList() {
    return parent::GetEntityManager()
      ->GetRepository(Inschrijfadres::class)
      ->findAll();
  }

  public function getById($id) {
    return parent::GetEntityManager()
      ->GetRepository(Inschrijfadres::class)
      ->find($id);
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
