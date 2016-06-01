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

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\DBAL\DriverManager;
use Doctrine\Common\Collections\ArrayCollection;

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

$wedstrijd = new Wedstrijd();
$wedstrijd->wedstrijd_id = 1;
$wedstrijd->toernooi_id = 1;
$wedstrijd->subtoernooi_id = 1;
$wedstrijd->team1 = 1;
$wedstrijd->team2 = 2;
$wedstrijd->start_datum = new \DateTime('10-05-2010 00:00:00.000');
$wedstrijd->poulecode = 'A';

$subtoernooi = $em->GetRepository(SubToernooi::class)->find(array('toernooi_id' => 1, 'subtoernooi_id' => 1));
$wedstrijd->subtoernooi = $subtoernooi;
$subtoernooi->wedstrijd_collection->add($wedstrijd);

$werknemer = $em->GetRepository(Werknemer::class)->find(1);
$werknemer->wedstrijd = $wedstrijd;
$wedstrijd->werknemer = $werknemer;

$em->persist($wedstrijd);
$em->flush();

?>
