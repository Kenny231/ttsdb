<?php

require_once 'libs/slim/vendor/autoload.php';
require_once 'partials/Login/Backend/Entity/Persoon.php';
require_once 'partials/Login/Backend/Entity/Werknemer.php';
require_once 'partials/Login/Backend/Entity/Functie.php';
require_once 'partials/Toernooi/Backend/Entity/Toernooi.php';
require_once 'partials/Toernooi/Backend/Entity/SubToernooi.php';
require_once 'partials/Resources/Backend/Entity/Adres.php';
require_once 'partials/Inschrijfadres/Backend/Entity/Inschrijfadres.php';
require_once 'partials/Registratie/Backend/Entity/Leeftijdscategorie.php';
require_once 'partials/Registratie/Backend/Entity/Speler.php';
require_once 'partials/Wedstrijd/Backend/Entity/Wedstrijd.php';
require_once 'partials/Toernooi/Backend/Entity/Licentie.php';
require_once 'partials/Registratie/Backend/Entity/Team.php';
require_once 'partials/Wedstrijd/Backend/Entity/Score.php';

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
use Resources\Backend\Entity\Adres;
use Inschrijfadres\Backend\Entity\Inschrijfadres;
use Registratie\Backend\Entity\Leeftijdscategorie;
use Registratie\Backend\Entity\Speler;
use Wedstrijd\Backend\Entity\Wedstrijd;
use Wedstrijd\Backend\Entity\Score;

$config = Setup::createAnnotationMetadataConfiguration(array('../partials/'), true);
$params = array(
  'dbname' => 'ttsdb',
  'user' => 'localhost',
  'password' => 'ise2016',
  'host' => 'KENNY',
  'driver' => 'sqlsrv'
);
$em = EntityManager::create($params, $config);

/*$adres = new Adres();
$adres->postcode = '3214DS';
$adres->huisnummer = '6';
$adres->plaatsnaam = 'Plaats';
$adres->straatnaam = 'Straat';

$toernooi = new Toernooi();
$toernooi->toernooinaam = 'toernooi';
$toernooi->vereniging_naam = 'Vereniging';
$toernooi->start_datum = new \DateTime("2010-05-05");
$toernooi->eind_datum = new \DateTime("2010-06-06");
$toernooi->organisatie = "Organisatie";
$toernooi->goedkeuring = '0';
$toernooi->toernooitype = 'Ladder';
$toernooi->max_aantal_spelers = '5';

$toernooi->adres = $adres;
$adres->toernooi_collection->add($toernooi);

$em->persist($toernooi);
$em->flush();*/

/*$adres = new Adres();
$adres->postcode = '3214DS';
$adres->huisnummer = '6';
$adres->plaatsnaam = 'Plaats';
$adres->straatnaam = 'Straat';

$inschrijfadres = new Inschrijfadres();
$inschrijfadres->telefoonnummer     = '4358475648';
$inschrijfadres->email          	  = 'dnjdas@cnadsa.com';

$werknemer = $em->GetRepository(Werknemer::class)->find('1');
$werknemer->inschrijfadres = $inschrijfadres;
$inschrijfadres->werknemer = $werknemer;

$inschrijfadres->adres = $adres;
$adres->inschrijfadres_collection->add($inschrijfadres);

$em->persist($inschrijfadres);
$em->flush();*/

$rsm = new ResultSetMapping();
$rsm->addEntityResult(Score::class, 's');
$rsm->addScalarResult('SCORES', 'scores');

$sql = 'select count(1) / 2 as SCORES
        from score
        where toernooi_id = 3 and subtoernooi_id = 1 and wedstrijd_id = 1;
       ';
$query = $em->createNativeQuery($sql, $rsm);

print_r($query->getResult()[0]['scores']);


/*$subtoernooi = $em->GetRepository(SubToernooi::class)->find(array(
  'toernooi_id' => 1,
  'subtoernooi_id' => 2
));

$subtoernooi->toernooi_id = 1;
$subtoernooi->subtoernooi_id = 2;
$subtoernooi->geslacht = 'v';
$subtoernooi->enkel = 1;

$leeftijdscategorie = $em->GetRepository(Leeftijdscategorie::class)->find('Welp');
$subtoernooi->leeftijdscategorie = $leeftijdscategorie;
$leeftijdscategorie->subtoernooi = $subtoernooi;

$licenties = array('A', 'B', 'C');
foreach ($licenties as $key => $val) {
  $licentie = new Licentie();
  $licentie->toernooi_id = 1;
  $licentie->subtoernooi_id = 2;
  $licentie->licentie = $val;

  $subtoernooi->licentie_collection->add($licentie);
  $licentie->subtoernooi = $subtoernooi;
}

$em->persist($subtoernooi);
$em->flush(); */

?>
