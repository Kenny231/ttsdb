<?php
require_once 'libs/slim/vendor/autoload.php';
require_once 'partials/Inschrijfadres/Backend/Entity/Inschrijfadres.php';

use \Inschrijfadres\Backend\Entity\Inschrijfadres;
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

$inschrijfadres = $em->GetRepository(Inschrijfadres::class);
$test = $inschrijfadres->find(13);

print_r($test);




?>
