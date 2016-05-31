<?php

namespace Resources\Backend\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="Adres")
 */
class Adres
{
  /**
   * @Id
   * @Column(type="string", length=6)
   */
  protected $postcode;
  /**
  * @Id
  * @Column(type="string", length=10)
  */
  protected $huisnummer;
  /**
   * @Column(type="string", length=75)
   */
  protected $straatnaam;
  /**
   * @Column(type="string", length=75)
   */
  protected $plaatsnaam;
  /**
   * @OneToMany(targetEntity="Toernooi\Backend\Entity\Toernooi", mappedBy="adres", cascade={"persist"})
   */
  protected $toernooi_collection;
  /**
   * @OneToMany(targetEntity="Inschrijfadres\Backend\Entity\Inschrijfadres", mappedBy="adres", cascade={"persist"})
   */
  protected $inschrijfadres_collection;

  public function __construct() {
    $this->toernooi_collection = new ArrayCollection();
    $this->inschrijfadres_collection = new ArrayCollection();
  }

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }
}

?>
