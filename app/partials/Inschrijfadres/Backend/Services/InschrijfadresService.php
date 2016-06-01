<?php

namespace Inschrijfadres\Backend\Services;

use Resources\Backend\Service\BaseService;

use Resources\Backend\Entity\Adres;
use Login\Backend\Entity\Werknemer;
use Inschrijfadres\Backend\Entity\Inschrijfadres;
use Toernooi\Backend\Entity\SubToernooi;

class InschrijfadresService extends BaseService
{
  public function addInschrijfadres($data) {
    $em = parent::GetEntityManager();
    $inschrijfadres = $this->createInschrijfadres($data);
    $em->persist($inschrijfadres);
    $em->flush();
  }

  public function updateInschrijfadres($data) {
    $em = parent::GetEntityManager($data);
    $inschrijfadres = $this->createInschrijfadres($data, $this->getById(array('toernooi_id' => $data['toernooi_id'], 'subtoernooi_id' => $data['subtoernooi_id'])));
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

  private function getSubtoernooiById($id) {
    return parent::GetEntityManager()
      ->GetRepository(SubToernooi::class)
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
    } else {
      $adres->plaatsnaam         = $data['plaatsnaam'];
      $adres->straatnaam         = $data['straatnaam'];
    }

    $inschrijfadres->toernooi_id        = $data['toernooi_id'];
    $inschrijfadres->subtoernooi_id     = $data['subtoernooi_id'];
    $inschrijfadres->telefoonnummer     = $data['telefoonnummer'];
    $inschrijfadres->email          	  = $data['email'];

    $werknemer = $this->getWerknemerById($data['persoon_id']);
    $werknemer->inschrijfadres = $inschrijfadres;
    $inschrijfadres->werknemer = $werknemer;

    $subtoernooi = $this->getSubtoernooiById(array('toernooi_id' => $data['toernooi_id'], 'subtoernooi_id' => $data['subtoernooi_id']));
    $subtoernooi->inschrijfadres = $inschrijfadres;
    $inschrijfadres->subtoernooi = $subtoernooi;

    $inschrijfadres->adres = $adres;
    $adres->inschrijfadres_collection->add($inschrijfadres);

    return $inschrijfadres;
  }
}

?>
