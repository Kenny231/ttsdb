<?php
namespace Login\Backend\Services;

use Login\Backend\Entity\Persoon;
use Resources\Backend\Service\BaseService;

class LoginService extends BaseService
{
  public function findUserByUsername($username) {
    return parent::GetEntityManager()
      ->getRepository(Persoon::class)
      ->findOneBy(array('voornaam' => $username));
  }

  public function findUserById($id) {
    return parent::GetEntityManager()
      ->getRepository(Persoon::class)
      ->find($id);
  }
}
?>
