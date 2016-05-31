<?php

namespace Inschrijfadres\Backend\Services;

use Resources\Backend\Service\BaseService;

use Resources\Backend\Entity\Adres;
use Login\Backend\Entity\Werknemer;
use Login\Backend\Entity\Inschrijfadres;

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

  private function getAdresById($id) {
    return parent::GetEntityManager()
      ->GetRepository(Adres::class)
      ->find($id);
  }

  private function getWerknemerById($id) {
    return parent::GetEntityManager()
      ->GetRepository(Werknemer::class)
      ->find($id);
  }

  private function createInschrijfadres($data, $entity = null) {
    $inschrijfadres = null;
    if ($entity == null)
      $inschrijfadres = new Inschrijfadres();
    else
      $inschrijfadres = $entity;

    $adres = $this->getAdresById(array('postcode' => $data['postcode'], 'huisnummer' => $data['huisnummer']));
    if ($adres == null) {
      $adres = new Adres();
      $adres->postcode           = $data['postcode'];
      $adres->plaatsnaam         = $data['plaatsnaam'];
      $adres->straatnaam         = $data['straatnaam'];
      $adres->huisnummer         = $data['huisnummer'];
    }

    $werknemer = $this->getWerknemerById($data['persoon_id']);
    $werknemer->inschrijfadres = $inschrijfadres;
    $inschrijfadres->werknemer = $werknemer;

    $inschrijfadres->telefoonnummer     = $data['telefoonnummer'];
    $inschrijfadres->email          	  = $data['email'];

    $inschrijfadres->adres = $adres;
    $adres->inschrijfadres_collection->add($inschrijfadres);

    return $inschrijfadres;
  }
}

?>
