<?php

namespace Account\Backend\Service;

use Account\Backend\Entity\Account;
use Resources\Backend\Service\BaseService;

class AccountService extends BaseService
{
	public function findUserByUsername($username) {
		return parent::GetEntityManager()
			->getRepository(Account::class)
			->findOneBy(array('username' => $username));
	}
}

?>
