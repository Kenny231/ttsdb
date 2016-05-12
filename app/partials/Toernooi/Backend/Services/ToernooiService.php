<?php

namespace Toernooi\Backend\Services;

use Toernooi\Backend\Entity\Toernooi;
use Resources\Backend\Service\BaseService;

class ToernooiService extends BaseService
{
  public function addToernooi($data) {
    $em = parent::GetEntityManager();
    $toernooi = $this->createToernooi($data);
    $em->persist($toernooi);
    $em->flush();
  }

  public function deleteToernooi($id) {
    $em = parent::GetEntityManager();
    $toernooi = $em->getReference(Toernooi::class, $id);
    $em->remove($toernooi);
    $em->flush();
  }

  public function getList() {
    return parent::GetEntityManager()
      ->GetRepository(Toernooi::class)
      ->findAll();
  }

  public function getById($id) {
    return parent::GetEntityManager()
      ->GetRepository(Toernooi::class)
      ->find($id);
  }

  private function createToernooi($data) {
    $toernooi = new Toernooi();

    $toernooi->toernooi_naam      = $data['naam'];
    $toernooi->toernooitype       = $data['type'];
    $toernooi->geslacht           = $data['geslacht'] != 'mv' ? $data['geslacht'] : null;
    $toernooi->enkel              = $data['enkel'];
    $toernooi->start_datum        = new \DateTime($data['start_datum'] . ' ' . $data['tijd']);
    $toernooi->eind_datum         = new \DateTime($data['eind_datum']);
    $toernooi->organisatie        = $data['organisatie'];
    // Default waardes voor nu
    $toernooi->postcode           = '4325KB';
    $toernooi->vereniging_naam    = 'Vereniging';
    $toernooi->goedkeuring        = 0;

    return $toernooi;
  }
}

?>
