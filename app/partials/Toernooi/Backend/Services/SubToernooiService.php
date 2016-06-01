<?php

namespace Toernooi\Backend\Services;

use Doctrine\ORM\Query\ResultSetMapping;

use Toernooi\Backend\Entity\SubToernooi;
use Resources\Backend\Service\BaseService;

class SubToernooiService extends BaseService
{
  public function addToernooi($data) {
    // Stored procedure
  }

  public function updateToernooi($data) {
    // Stored procedure
  }

  public function deleteToernooi($id) {
    $em = parent::GetEntityManager();
    $toernooi = $em->getReference(SubToernooi::class, $id);
    $em->remove($toernooi);
    $em->flush();
  }

  public function getById($id) {
    return parent::GetEntityManager()
      ->GetRepository(SubToernooi::class)
      ->find($id);
  }

  private function getResultSetMap() {
    $rsm = new ResultSetMapping();
    $rsm->addEntityResult(SubToernooi::class, 't');
    $rsm->addFieldResult('t', 'TOERNOOI_ID', 'toernooi_id');
    $rsm->addFieldResult('t', 'SUBTOERNOOI_ID', 'subtoernooi_id');
    $rsm->addFieldResult('t', 'CATEGORIE_NAAM', 'categorie_naam');
    $rsm->addFieldResult('t', 'GESLACHT', 'geslacht');
    $rsm->addFieldResult('t', 'ENKEL', 'enkel');

    return $rsm;
  }

  public function getList($toernooi_id) {
    $em = parent::GetEntityManager();

    $rsm = $this->getResultSetMap();
    $sql = 'SELECT * FROM SUBTOERNOOI WHERE toernooi_id = 1';
    $query = $em->createNativeQuery($sql, $rsm);

    return $query->getResult();
  }

  public function findAvailableSub($persoon_id, $toernooi_id) {
    $em = parent::GetEntityManager();

    $rsm = $this->getResultSetMap();
    $sql = 'SELECT * FROM [dbo].fnGetMogelijkeSubToernooien(' . $persoon_id . ') WHERE toernooi_id = ' . $toernooi_id;
    $query = $em->createNativeQuery($sql, $rsm);

    return $query->getResult();
  }

  private function createToernooi($data, $entity = null) {
    // Stored procedure.
  }
}

?>
