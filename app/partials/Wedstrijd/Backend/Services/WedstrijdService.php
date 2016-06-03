<?php

namespace Wedstrijd\Backend\Services;

use Doctrine\ORM\Query\ResultSetMapping;

use Wedstrijd\Backend\Entity\Wedstrijd;
use Resources\Backend\Service\BaseService;

class WedstrijdService extends BaseService
{
  const TOERNOOI = 'Toernooi\Backend\Entity\Toernooi';

  public function createWedstrijd($data) {
    $toernooitype = parent::find(self::TOERNOOI, $data['toernooi_id']);
    switch ($toernooitype)
    {
      case 'Prestatie':
        $this->createPrestatieWedstrijd($data);
        break;
      case 'Ladder':
        $this->createLadderWedstrijd($data);
        break;
      case 'Familie':
        $this->createFamilieWedstrijd($data);
        break;
      default:
        break;
    }
  }

  private function createPrestatieWedstrijd($data) {
    $conn = parent::GetEntityManager()->getConnection();
  }
  private function createLadderWedstrijd($data) {
    $conn = parent::GetEntityManager()->getConnection();
  }
  private function createFamilieWedstrijd($data) {
    $conn = parent::GetEntityManager()->getConnection();
  }

  private function getResultSetMap() {
    $rsm = new ResultSetMapping();
    $rsm->addEntityResult(Wedstrijd::class, 'w');
    $rsm->addFieldResult('w', 'TOERNOOI_ID', 'toernooi_id');
    $rsm->addFieldResult('w', 'SUBTOERNOOI_ID', 'subtoernooi_id');
    $rsm->addFieldResult('w', 'WEDSTRIJD_ID', 'wedstrijd_id');
    $rsm->addFieldResult('w', 'TEAM1', 'team1');
    $rsm->addFieldResult('w', 'TEAM2', 'team2');
    $rsm->addFieldResult('w', 'SCHEIDSRECHTER', 'scheidsrechter');
    $rsm->addFieldResult('w', 'START_DATUM', 'start_datum');
    $rsm->addFieldResult('w', 'POULECODE', 'poulecode');

    return $rsm;
  }

  public function getWedstrijdList($toernooi_id, $subtoernooi_id) {
    $em = parent::GetEntityManager();

    $rsm = $this->getResultSetMap();
    $sql = 'SELECT * FROM WEDSTRIJD WHERE toernooi_id = ' . $toernooi_id . ' AND subtoernooi_id = ' . $subtoernooi_id;
    $query = $em->createNativeQuery($sql, $rsm);

    return $query->getResult();
  }
}

?>
