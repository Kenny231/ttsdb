<?php

namespace Login\Backend\Entity;

/**
 * @Entity @Table(name="PERSOON")
 */
class Persoon
{
  /**
  * @Id
  * @Column(type="integer")
  */
  protected $persoon_id;


  /**
  * @Column(type="string", length=6)
  */
  protected $postcode;

  /**
  * @Column(type="string")
  */
  protected $vereniging_naam;

  /**
  * @Column(type="string")
  */
  protected $voornaam;

  /**
  * @Column(type="string")
  */
  protected $achternaam;

  /**
  * @Column(type="string", length=1)
  */
  protected $geslacht;

  /**
  * @Column(type="datetime")
  */
  protected $geboortedatum;

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }
}

 ?>
