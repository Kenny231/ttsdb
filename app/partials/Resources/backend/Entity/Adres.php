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
   * @Column(name="postcode", type="string", length=6)
   */
  protected $id;
  /**
   * @Column(type="string", length=75)
   */
  protected $straatnaam;
  /**
   * @Column(type="string", length=75)
   */
  protected $plaatsnaam;
   /**
    * @Column(type="string", length=10)
    */
  protected $huisnummer;
  /**
   * @OneToMany(targetEntity="Toernooi\Backend\Entity\Toernooi", mappedBy="adres", cascade={"persist"})
   */
  protected $toernooi_collection;

  public function __construct() {
    $this->toernooi_collection = new ArrayCollection();
  }

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }
}

?>
