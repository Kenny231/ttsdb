<?php

require_once 'libs/slim/vendor/autoload.php';
require_once 'partials/Login/Backend/Entity/Persoon.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

use Login\Backend\Entity\Persoon;

$config = Setup::createAnnotationMetadataConfiguration(array('../partials/'), true);
$conn = array(
  'dbname' => 'ttsdb',
  'user' => 'localhost',
  'password' => 'ise2016',
  'host' => 'KENNY',
  'driver' => 'sqlsrv'
);
$em = EntityManager::create($conn, $config);

$rsm = new ResultSetMappingBuilder($em);
$rsm->addEntityResult(Persoon::class, 'p');
$rsm->addFieldResult('p', 'PERSOON_ID', 'persoon_id');
$rsm->addFieldResult('p', 'POSTCODE', 'postcode');
$rsm->addFieldResult('p', 'VERENIGING_NAAM', 'vereniging_naam');
$rsm->addFieldResult('p', 'VOORNAAM', 'voornaam');
$rsm->addFieldResult('p', 'ACHTERNAAM', 'achternaam');
$rsm->addFieldResult('p', 'GESLACHT', 'geslacht');
$rsm->addFieldResult('p', 'GEBOORTEDATUM', 'geboortedatum');


$sql = 'SELECT * FROM [dbo].getPersonen()';
$query = $em->createNativeQuery($sql, $rsm);

$result = $query->getResult();

print_r($result);

?>
