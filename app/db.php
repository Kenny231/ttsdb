<?php

require_once 'libs/slim/vendor/autoload.php';
require_once 'partials/Login/Backend/Entity/Persoon.php';
require_once 'partials/Toernooi/Backend/Entity/Toernooi.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\DBAL\DriverManager;

use Login\Backend\Entity\Persoon;
use Toernooi\Backend\Entity\Toernooi;

$config = Setup::createAnnotationMetadataConfiguration(array('../partials/'), true);
$params = array(
  'dbname' => 'ttsdb',
  'user' => 'localhost',
  'password' => 'ise2016',
  'host' => 'KENNY',
  'driver' => 'sqlsrv'
);
$em = EntityManager::create($params, $config);

$config = new \Doctrine\DBAL\Configuration();
//$conn = DriverManager::getConnection($params, $config);
$conn = $em->getConnection();
$sql = 'exec prcSpelerToevoegenAanToernooi ?, ?';
$stmt = $conn->prepare('exec prcSpelerToevoegenAanToernooi ?, ?, ?, ?');
$stmt->bindValue(1, 1);
$stmt->bindValue(2, 5);
$stmt->bindValue(3, null);
$stmt->bindValue(4, null);
$stmt->execute();

?>
