<?php

namespace Inschrijfadres\Backend\Entity;



/**
 * @Entity @Table(name="Inschrijfadres")
 */
class Inschrijfadres
{


  /**
  * @Id
  * @GeneratedValue
  * @Column(type="integer")
  */
  protected $inschrijfadres_id;


  /**
  * @Column(type="string", length=6)
  */
  protected $postcode;

  /**
  * @Column(type="string", length=10)
  */
  protected $huisnummer;

  /**
  * @Column(type="string", length=15)
  */
  protected $categorie_naam;

  /**
  * @Column(type="integer")
  */
  protected $persoon_id;

  /**
  * @Column(type="decimal", precision=10)
  */
  protected $telefoonnummer;

  /**
  * @Column(type="string", length=100)
  */
  protected $email;



  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }

}











 ?>
