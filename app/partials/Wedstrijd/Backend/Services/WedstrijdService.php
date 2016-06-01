<?php

namespace Wedstrijd\Backend\Services;

use Wedstrijd\Backend\Entity\Wedstrijd;
use Resources\Backend\Service\BaseService;
use Toernooi\Backend\Entity\SubToernooi;
use Login\Backend\Entity\Werknemer;

class WedstrijdService  extends BaseService
{
  public function addWedstrijd($data) {
    $em = parent::GetEntityManager();
    $wedstrijd = $this->createWedstrijd($data);
    $em->persist($wedstrijd);
    $em->flush();
  }

  public function updateWedstrijd($data) {
    $em = parent::GetEntityManager($data);
    $wedstrijd = $this->createWedstrijd($data, $this->getById($data['wedstrijd_id'],$data['subtoernooi_id'],$data['toernooi_id']));
    $em->persist($wedstrijd);
    $em->flush();
  }

  public function deleteWedstrijd($wedstrijd_id, $subtoernooi_id, $toernooi_id) {
    $em = parent::GetEntityManager();
    $wedstrijd = $em->getReference(Wedstrijd::class, array("wedstrijd_id" => $wedstrijd_id , "subtoernooi_id" => $subtoernooi_id, "toernooi_id" => $toernooi_id));
    $em->remove($wedstrijd);
    $em->flush();
  }

  public function getList() {
    return parent::GetEntityManager()
    ->GetRepository(Wedstrijd::class)
    ->findAll();
  }

  public function getById($wedstrijd_id, $subtoernooi_id, $toernooi_id) {
    return parent::GetEntityManager()
    ->GetRepository(Wedstrijd::class)
    ->find(array("wedstrijd_id" => $wedstrijd_id , "subtoernooi_id" => $subtoernooi_id, "toernooi_id" => $toernooi_id));
  }

  private function getSubtoernooiById($id) {
    return parent::GetEntityManager()
      ->GetRepository(SubToernooi::class)
      ->find($id);
  }

  private function getWerknemerById($id) {
    return parent::GetEntityManager()
      ->GetRepository(Werknemer::class)
      ->find($id);
  }

  private function createWedstrijd($data, $entity = null) {
    $wedstrijd = null;
    if ($entity == null)
      $wedstrijd = new Wedstrijd();
    else
      $wedstrijd = $entity;

    $wedstrijd->wedstrijd_id        = $data['wedstrijd_id'];
    $wedstrijd->toernooi_id         = $data['toernooi_id'];
    $wedstrijd->subtoernooi_id      = $data['subtoernooi_id'];
    $wedstrijd->team1               = $data['team1'];
    $wedstrijd->team2               = $data['team2'];
    $wedstrijd->start_datum         = new \DateTime($data['start_datum']);
    $wedstrijd->poulecode           = $data['poulecode'];

    $subtoernooi = $this->getSubtoernooiById(array('toernooi_id' => $data['toernooi_id'], 'subtoernooi_id' => $data['subtoernooi_id']));
    $wedstrijd->subtoernooi = $subtoernooi;
    $subtoernooi->wedstrijd_collection->add($wedstrijd);

    $werknemer = $this->getWerknemerById($data['scheidsrechter']);
    $werknemer->wedstrijd = $wedstrijd;
    $wedstrijd->werknemer = $werknemer;

    return $wedstrijd;
  }
}

?>
