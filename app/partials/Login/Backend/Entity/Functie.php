<?php

namespace Login\Backend\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="Functie")
 */
class Functie
{
  public function __construct() {
    $this->werknemer_collection = new ArrayCollection();
  }
  /**
   * @Id
   * @Column(type="string", length=75)
   */
  protected $functie_naam;

  /**
   * @Column(type="string")
   */
  protected $functie_omschrijving;

  /**
   * @OneToMany(targetEntity="Login\Backend\Entity\Werknemer", mappedBy="functie")
   */
  protected $werknemer_collection;

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }
}

?>
