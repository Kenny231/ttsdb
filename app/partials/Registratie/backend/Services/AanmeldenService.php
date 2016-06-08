<?php

namespace Registratie\Backend\Services;

use Resources\Backend\Service\BaseService;

class AanmeldenService extends BaseService
{
  public function addSpelerToToernooi($persoon_id, $toernooi_id, $subtoernooi_id, $team_naam, $partner_id) {
    $conn = parent::GetEntityManager()->getConnection();

    $stmt = $conn->prepare('exec prcSpelerToevoegenAanToernooi ?, ?, ?, ?, ?');
    $stmt->bindValue(1, $persoon_id);
    $stmt->bindValue(2, $subtoernooi_id);
    $stmt->bindValue(3, $toernooi_id);
    $stmt->bindValue(4, $team_naam);
    $stmt->bindValue(5, $partner_id);
    $stmt->execute();
  }
}

?>
