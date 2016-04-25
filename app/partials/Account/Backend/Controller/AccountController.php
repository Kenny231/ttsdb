<?php

namespace Account\Backend\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Account\Backend\Entity\Account;
use Account\Backend\Service\AccountService;

class AccountController
{
	private $accountService;
	public function __construct($container) {
		$this->accountService = $container->AccountService;
	}

	private function construct_error($error_msg) {
		return array(
			'error' => $error_msg
		);
	}

	public function login($request, $response, $args) {
		$data = $request->getParsedBody();

		$username = $data['username'];
		$password = $data['password'];

		$user = $this->accountService->findUserByUsername($username);
		if (!$user instanceof Account || $password != $user->getPassword())
			return $response->withJson($this->construct_error("Invalid username or password."));

		return $response->withJson("Success");
	}
}

?>
