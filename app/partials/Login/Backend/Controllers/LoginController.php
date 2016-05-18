<?php

namespace Login\Backend\Controllers;

use Login\Backend\Entity\Persoon;

class LoginController
{
  private $loginService;

  public function __construct($container){
    $this->loginService = $container->LoginService;
  }

  private function construct_error($error_msg){
    return  array(
    'error' => $error_msg
   );
  }

   public function login($request, $response, $args){
    $data = $request->getParsedBody();

    $username = $data['username'];
    $password = $data['password'];

    $user = $this->loginService->findUserByUsername($username);
    if (!$user instanceof Persoon || $password != $user->achternaam)
      return $response->withJson($this->construct_error('Gebruikersnaam of wachtwoord onjuist.'));

    return $response->withJson("success");
  }
}
?>
