<?php

namespace Account\Backend\Entity;

/**
 * @Entity @Table(name="Account")
 */
class Account
{
    /**
     * @Id @Column(type="string")
     * @var string
     */
	protected $username;
    /**
     * @Column(type="string")
     * @var string
     */
	protected $password;

	public function getUsername() {
		return $this->username;
	}
	public function getPassword() {
		return $this->password;
	}

	public function setUsername($username) {
		$this->username = $username;
	}
	public function setPassword($password) {
		$this->password = $password;
	}
}
?>
