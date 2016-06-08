<?php

namespace Toernooi\Backend\Services;

use Resources\Backend\Service\BaseService;
use Doctrine\ORM\Query\ResultSetMapping;
use Toernooi\Backend\Entity\ToernooiPoule;

class ToernooiOverzichtService extends BaseService
{

 public function createPoules($data){
     $conn = parent::GetEntityManager()->getConnection();

     $stmt = $conn->prepare('exec prcSetPoules ?, ?, ?');
     $stmt->bindValue(1, $data['toernooi_id']);
     $stmt->bindValue(2, $data['subtoernooi_id']);
     $stmt->bindValue(3, $data['aantal_poules']);
     $stmt->execute();
 }
 private function getResultSetMap() {
   $rsm = new ResultSetMapping();
   $rsm->addEntityResult(ToernooiPoule::class, 'TP');
   $rsm->addFieldResult('TP', 'TOERNOOI_ID', 'toernooi_id');
   $rsm->addFieldResult('TP', 'SUBTOERNOOI_ID', 'subtoernooi_id');
   $rsm->addFieldResult('TP', 'TEAM_ID', 'team_id');
   $rsm->addFieldResult('TP', 'POULE', 'poule');
   $rsm->addFieldResult('TP', 'WINS', 'wins');
   $rsm->addFieldResult('TP', 'POSITION', 'position');
   return $rsm;
 }


 public function getAllPoules($toernooi_id,$subtoernooi_id){
    $em = parent::GetEntityManager();

    $rsm = $this->getResultSetMap();
    $sql = 'SELECT *
            FROM ToernooiPoule
            WHERE toernooi_id = '. $toernooi_id . ' AND subtoernooi_id = ' . $subtoernooi_id;
    $query = $em->createNativeQuery($sql, $rsm);

    return $query->getResult();
 }




}



 ?>
