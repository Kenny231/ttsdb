<?php
require_once 'libs/slim/vendor/autoload.php';
require_once 'partials/Wedstrijd/Backend/Entity/Wedstrijd.php';

use \Wedstrijd\Backend\Entity\Wedstrijd;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$config = Setup::createAnnotationMetadataConfiguration(array("../partials/"), true);
$conn = array(
    'dbname' => 'ttsdb',
    'user' => 'sa',
    'password' => 'psnwo',
    'host' => 'DESKTOP-2PJ7N6S',
    'driver' => 'sqlsrv',
);
$em = EntityManager::create($conn, $config);



$wedstrijd = $em->find(Wedstrijd::class, array("wedstrijd_id" => 3 , "subtoernooi_id" => 2, "toernooi_id" => 3));

echo $wedstrijd->team1;





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
