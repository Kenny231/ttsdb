<?php

namespace Toernooi\Backend\Services;

use Resources\Backend\Service\BaseService;

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


}



 ?>
