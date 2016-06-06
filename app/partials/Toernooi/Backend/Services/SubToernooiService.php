<?php

namespace Toernooi\Backend\Services;

use Doctrine\ORM\Query\ResultSetMapping;

use Toernooi\Backend\Entity\SubToernooi;
use Resources\Backend\Service\BaseService;

class SubToernooiService extends BaseService
{
  public function createSubToernooi($data) {
    $conn = parent::GetEntityManager()->getConnection();

    $licenties = '';
    foreach($data['licenties'] as $value) {
      $licenties = $licenties . $value . ',';
    }
    $licenties = substr($licenties, 0, -1);

    $stmt = $conn->prepare('exec prcPlaatsSubtoernooi ?, ?, ?, ?, ?');
    $stmt->bindValue(1, $data['toernooi_id']);
    $stmt->bindValue(2, $data['categorie_naam']);
    $stmt->bindValue(3, $data['geslacht']);
    $stmt->bindValue(4, $data['enkel']);
    $stmt->bindValue(5, $licenties);
    $stmt->execute();
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

  public function getSubToernooiList($toernooi_id) {
    $em = parent::GetEntityManager();

    $rsm = $this->getResultSetMap();
    $sql = 'SELECT * FROM SUBTOERNOOI WHERE toernooi_id = ' . $toernooi_id;
    $query = $em->createNativeQuery($sql, $rsm);

    return $query->getResult();
  }

  public function findAvailable($toernooi_id, $persoon_id) {
    $em = parent::GetEntityManager();

    $rsm = $this->getResultSetMap();
    $sql = 'SELECT * FROM [dbo].fnGetMogelijkeSubToernooien(' . $persoon_id . ') WHERE toernooi_id = ' . $toernooi_id;
    $query = $em->createNativeQuery($sql, $rsm);

    return $query->getResult();
  }
}

?>
