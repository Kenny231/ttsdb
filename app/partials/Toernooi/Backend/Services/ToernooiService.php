<?php

namespace Toernooi\Backend\Services;

use Doctrine\ORM\Query\ResultSetMapping;

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

  public function updateToernooi($data) {
    $em = parent::GetEntityManager($data);
    $toernooi = $this->createToernooi($data, $this->getById($data['id']));
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

  public function findAvailable($persoon_id) {
    $em = parent::GetEntityManager();

    $rsm = new ResultSetMapping();
    $rsm->addEntityResult(Toernooi::class, 't');
    $rsm->addFieldResult('t', 'TOERNOOI_ID', 'toernooi_id');
    $rsm->addFieldResult('t', 'TOERNOOI_NAAM', 'toernooi_naam');
    $rsm->addFieldResult('t', 'VERENIGING_NAAM', 'vereniging_naam');
    $rsm->addFieldResult('t', 'POSTCODE', 'postcode');
    $rsm->addFieldResult('t', 'START_DATUM', 'start_datum');
    $rsm->addFieldResult('t', 'EIND_DATUM', 'eind_datum');
    $rsm->addFieldResult('t', 'ORGANISATIE', 'organisatie');
    $rsm->addFieldResult('t', 'GOEDKEURING', 'goedkeuring');
    $rsm->addFieldResult('t', 'TOERNOOITYPE', 'toernooitype');
    $rsm->addFieldResult('t', 'GESLACHT', 'geslacht');
    $rsm->addFieldResult('t', 'ENKEL', 'enkel');

    $sql = 'SELECT * FROM [dbo].fnGetMogelijkeToernooien(' . $persoon_id . ')';
    $query = $em->createNativeQuery($sql, $rsm);

    return $query->getResult();
  }

  private function createToernooi($data, $entity = null) {
    $toernooi = null;
    if ($entity == null)
      $toernooi = new Toernooi();
    else
      $toernooi = $entity;

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
