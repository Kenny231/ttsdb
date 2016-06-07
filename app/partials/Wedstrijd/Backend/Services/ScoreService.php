<?php

namespace Wedstrijd\Backend\Services;

use Wedstrijd\Backend\Entity\Score;

use Resources\Backend\Service\BaseService;
use Doctrine\ORM\Query\ResultSetMapping;

class ScoreService extends BaseService
{
  public function addScore($data) {
    $conn = parent::GetEntityManager()->getConnection();

    $stmt = $conn->prepare('exec spPlaatsScore ?, ?, ?, ?, ?, ?, ?, ?');
    $stmt->bindValue(1, $data['toernooi_id']);
    $stmt->bindValue(2, $data['subtoernooi_id']);
    $stmt->bindValue(3, $data['wedstrijd_id']);
    $stmt->bindValue(4, $data['set']);
    $stmt->bindValue(5, $data['team1']);
    $stmt->bindValue(6, $data['team2']);
    $stmt->bindValue(7, $data['score_a']);
    $stmt->bindValue(8, $data['score_b']);
    $stmt->execute();
  }

  public function getAmountOfSets($data) {
    $em = parent::GetEntityManager();

    $rsm = new ResultSetMapping();
    $rsm->addEntityResult(Score::class, 's');
    $rsm->addScalarResult('SCORES', 'scores');

    $sql = 'SELECT COUNT(1) / 2 + 1 as SCORES
            FROM score
            WHERE toernooi_id = ' . $data['toernooi_id'] . '
            AND subtoernooi_id = ' . $data['subtoernooi_id'] . '
            AND wedstrijd_id = ' . $data['wedstrijd_id'] . ';
           ';
    $query = $em->createNativeQuery($sql, $rsm);

    return $query->getResult()[0]['scores'];
  }
}

?>
