<?php

namespace Login\Backend\Controllers;

use Login\Backend\Entity\Persoon;

class LoginController
{
  const PERSOON = 'Login\Backend\Entity\Persoon';

  private $baseService;
  public function __construct($container){
    $this->baseService = $container->BaseService;
  }

  private function construct_error($error_msg){
    return  array(
    'error' => $error_msg
   );
  }

  public function login($request, $response, $args) {
    $data = $request->getParsedBody();

    $username = $data['username'];
    $password = $data['password'];

    $user = $this->baseService->findOneBy(self::PERSOON, array('voornaam' => $username));
    if (!$user instanceof Persoon || $password != $user->achternaam)
      return $response->withJson($this->construct_error('Gebruikersnaam of wachtwoord onjuist.'));

    return $response->withJson(array(
      'voornaam' => $user->voornaam,
      'achternaam' => $user->achternaam,
      'persoon_id' => $user->persoon_id
    ));
  }

  public function findUserById($request, $response, $args) {
    $data = $request->getParsedBody();

    $user = $this->baseService->find(self::PERSOON, $data['id']);
    if (!$user instanceof Persoon)
      return $response->withJson($this->construct_error('Ongeldig lidnummer.'));

    return $response->withJson(array(
      'voornaam' => $user->voornaam,
      'achternaam' => $user->achternaam,
      'persoon_id' => $user->persoon_id
    ));
  }

}
?>
