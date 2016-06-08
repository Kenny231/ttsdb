<?php
require_once 'libs/slim/vendor/autoload.php';
require_once 'partials/Login/Backend/Entity/Persoon.php';
require_once 'partials/Login/Backend/Entity/Werknemer.php';
require_once 'partials/Login/Backend/Entity/Functie.php';
require_once 'partials/Toernooi/Backend/Entity/Toernooi.php';
require_once 'partials/Toernooi/Backend/Entity/SubToernooi.php';
require_once 'partials/Toernooi/Backend/Entity/ToernooiPoule.php';
require_once 'partials/Resources/Backend/Entity/Adres.php';
require_once 'partials/Inschrijfadres/Backend/Entity/Inschrijfadres.php';
require_once 'partials/Registratie/Backend/Entity/Leeftijdscategorie.php';
require_once 'partials/Registratie/Backend/Entity/Speler.php';
require_once 'partials/Wedstrijd/Backend/Entity/Wedstrijd.php';
require_once 'partials/Wedstrijd/Backend/Entity/Score.php';
require_once 'partials/Toernooi/Backend/Entity/Licentie.php';
require_once 'partials/Registratie/Backend/Entity/Team.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\DBAL\DriverManager;
use Doctrine\Common\Collections\ArrayCollection;

use Registratie\Backend\Entity\Team;
use Toernooi\Backend\Entity\Licentie;
use Login\Backend\Entity\Persoon;
use Login\Backend\Entity\Werknemer;
use Login\Backend\Entity\Functie;
use Toernooi\Backend\Entity\Toernooi;
use Toernooi\Backend\Entity\SubToernooi;
use Toernooi\Backend\Entity\ToernooiPoule;
use Resources\Backend\Entity\Adres;
use Inschrijfadres\Backend\Entity\Inschrijfadres;
use Registratie\Backend\Entity\Leeftijdscategorie;
use Registratie\Backend\Entity\Speler;
use Wedstrijd\Backend\Entity\Wedstrijd;
use Wedstrijd\Backend\Entity\Score;


$config = Setup::createAnnotationMetadataConfiguration(array("../partials/"), true);
$conn = array(
    'dbname' => 'ttsdb',
    'user' => 'sa',
    'password' => 'psnwo',
    'host' => 'DESKTOP-2PJ7N6S',
    'driver' => 'sqlsrv',
);

$em = EntityManager::create($conn, $config);
$rsm = new ResultSetMapping();
$rsm->addEntityResult(ToernooiPoule::class, 'TP');
$rsm->addFieldResult('TP', 'TOERNOOI_ID', 'toernooi_id');
$rsm->addFieldResult('TP', 'SUBTOERNOOI_ID', 'subtoernooi_id');
$rsm->addFieldResult('TP', 'TEAM_ID', 'team_id');
$rsm->addFieldResult('TP', 'POULE', 'poule');
$rsm->addFieldResult('TP', 'WINS', 'wins');
$rsm->addFieldResult('TP', 'POSITION', 'position');

$toernooi_id = 9;
$subtoernooi_id = 1;



 $sql = 'SELECT *
         FROM ToernooiPoule
         WHERE toernooi_id = '. $toernooi_id . ' AND subtoernooi_id = ' . $subtoernooi_id;
 $query = $em->createNativeQuery($sql, $rsm);

$resuper = $query->getResult();


    $ret_data = array();



    for ($i=0; $i<count($resuper);$i++) {
      array_push($ret_data, entityToArray($resuper[$i]));
    }
    $ret_data;





function entityToArray($entity) {
  return array(
    'toernooi_id' => $entity->toernooi_id,
    'subtoernooi_id' => $entity->subtoernooi_id,
    'team_id' => $entity->team_id,
    'poule' => $entity->poule,
    'wins' => $entity->wins,
    'position' => $entity->position
  );

}

print_r($ret_data);


/*
$toernooipoules = $em->getRepository(ToernooiPoule::class)->findAll();

print_r($toernooipoules);




/*
$connection = $em->getConnection();
$stmt = $connection->prepare('exec prcSetPoules ?, ?, ?');
$stmt->bindValue(1, 9);
$stmt->bindValue(2, 1);
$stmt->bindValue(3, 4);
$stmt->execute();







// delete
/*
$wedstrijd = $em->getReference(Wedstrijd::class, array("wedstrijd_id" => 2 , "subtoernooi_id" => 1, "toernooi_id" => 4));
$em->remove($wedstrijd);
$em->flush();

*/











/*
$wedstrijd = new Wedstrijd();


$wedstrijd->wedstrijd_id        =  1;
$wedstrijd->subtoernooi_id      =  2;
$wedstrijd->toernooi_id         =  3;
$wedstrijd->team1               =  1;
$wedstrijd->team2               =  2;
$wedstrijd->scheidsrechter      =  4;
$wedstrijd->start_datum         = new \Datetime('02-02-2016');
$wedstrijd->poulecode           = 'A';


$em->persist($wedstrijd);
$em->flush();
*/


?>
