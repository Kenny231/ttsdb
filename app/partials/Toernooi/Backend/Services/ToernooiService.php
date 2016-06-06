<?php

namespace Toernooi\Backend\Services;

use Doctrine\ORM\Query\ResultSetMapping;

use Toernooi\Backend\Entity\Toernooi;
use Resources\Backend\Service\BaseService;

class ToernooiService extends BaseService
{
  public function findAvailable($persoon_id) {
    $em = parent::GetEntityManager();

    $rsm = new ResultSetMapping();
    $rsm->addEntityResult(Toernooi::class, 't');
    $rsm->addFieldResult('t', 'TOERNOOI_ID', 'toernooi_id');
    $rsm->addFieldResult('t', 'TOERNOOINAAM', 'toernooinaam');
    $rsm->addFieldResult('t', 'VERENIGING_NAAM', 'vereniging_naam');
    $rsm->addFieldResult('t', 'POSTCODE', 'postcode');
    $rsm->addFieldResult('t', 'HUISNUMMER', 'huisnummer');
    $rsm->addFieldResult('t', 'START_DATUM', 'start_datum');
    $rsm->addFieldResult('t', 'EIND_DATUM', 'eind_datum');
    $rsm->addFieldResult('t', 'ORGANISATIE', 'organisatie');
    $rsm->addFieldResult('t', 'GOEDKEURING', 'goedkeuring');
    $rsm->addFieldResult('t', 'TOERNOOITYPE', 'toernooitype');
    $rsm->addFieldResult('t', 'MAX_AANTAL_SPELERS', 'max_aantal_spelers');

    $sql = 'SELECT * FROM [dbo].fnGetMogelijkeToernooien(' . $persoon_id . ')';
    $query = $em->createNativeQuery($sql, $rsm);

    return $query->getResult();
  }
}

?>
