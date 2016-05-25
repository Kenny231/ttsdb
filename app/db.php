<?php

require_once 'libs/slim/vendor/autoload.php';
require_once 'partials/Login/Backend/Entity/Persoon.php';
require_once 'partials/Toernooi/Backend/Entity/Toernooi.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

use Login\Backend\Entity\Persoon;
use Toernooi\Backend\Entity\Toernooi;

$config = Setup::createAnnotationMetadataConfiguration(array('../partials/'), true);
$conn = array(
  'dbname' => 'ttsdb',
  'user' => 'localhost',
  'password' => 'ise2016',
  'host' => 'KENNY',
  'driver' => 'sqlsrv'
);
$em = EntityManager::create($conn, $config);

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

/*$rsm->addEntityResult(Persoon::class, 'p');
$rsm->addFieldResult('p', 'PERSOON_ID', 'persoon_id');
$rsm->addFieldResult('p', 'POSTCODE', 'postcode');
$rsm->addFieldResult('p', 'VERENIGING_NAAM', 'vereniging_naam');
$rsm->addFieldResult('p', 'VOORNAAM', 'voornaam');
$rsm->addFieldResult('p', 'ACHTERNAAM', 'achternaam');
$rsm->addFieldResult('p', 'GESLACHT', 'geslacht');
$rsm->addFieldResult('p', 'GEBOORTEDATUM', 'geboortedatum');*/


$sql = 'SELECT * FROM [dbo].fnGetMogelijkeToernooien(1)';
$query = $em->createNativeQuery($sql, $rsm);

$result = $query->getResult();

print_r($result);

?>
