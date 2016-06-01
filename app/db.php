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

function getAdresById($id) {
  return $em->GetRepository(Adres::class)->find($id);
}

function createToernooi($data, $entity = null) {
  $toernooi = null;
  if ($entity == null)
    $toernooi = new Toernooi();
  else
    $toernooi = $entity;

  $adres = $this->getAdresById(array('postcode' => $data['postcode'], 'huisnummer' => $data['huisnummer']));
  if ($adres == null) {
    $adres = new Adres();
    $adres->postcode           = $data['postcode'];
    $adres->plaatsnaam         = $data['plaatsnaam'];
    $adres->straatnaam         = $data['straatnaam'];
    $adres->huisnummer         = $data['huisnummer'];
  } else {
    $adres->plaatsnaam         = $data['plaatsnaam'];
    $adres->straatnaam         = $data['straatnaam'];
  }

  $toernooi->toernooinaam      = $data['naam'];
  $toernooi->toernooitype       = $data['type'];
  $toernooi->start_datum        = new \DateTime($data['start_datum'] . ' ' . $data['tijd']);
  $toernooi->eind_datum         = new \DateTime($data['eind_datum']);
  $toernooi->organisatie        = $data['organisatie'];
  $toernooi->vereniging_naam    = 'Vereniging';
  $toernooi->goedkeuring        = 0;
  $toernooi->max_aantal_spelers = $data['max_aantal_spelers'];

  // Foreign key
  $toernooi->adres = $adres;
  $adres->toernooi_collection->add($toernooi);

  return $toernooi;
}


$toernooi = $em->GetRepository(Inschrijfadres::class)->find(array('toernooi_id' => 1, 'subtoernooi_id' => 1));
$adres = $em->GetRepository(Adres::class)->find(array('postcode' => $toernooi->adres->postcode, 'huisnummer' => $toernooi->adres->huisnummer));
$werknemer = $em->GetRepository(Werknemer::class)->find(1);
$subtoernooi = $em->GetRepository(Subtoernooi::class)->find(array('toernooi_id' => 1, 'subtoernooi_id' => 1));

$toernooi->email = 'blabla@bla.com';

$toernooi->adres = $adres;
$adres->inschrijfadres_collection->add($toernooi);

$werknemer->inschrijfadres = $toernooi;
$toernooi->werknemer = $werknemer;

$em->persist($toernooi);
$em->flush();

/*public function updateToernooi($data) {
  $em = parent::GetEntityManager($data);
  $toernooi = $this->createToernooi($data, $this->getById($data['id']));
  $em->persist($toernooi);
  $em->flush();
}*/


?>
