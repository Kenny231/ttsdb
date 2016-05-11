<?php

namespace Toernooi\Backend\Entity;


use \Doctrine\Common\Collections\ArrayCollection;
use Registratie\Backend\Entity\Team;

/**
 * @Entity @Table(name="Toernooi")
 */
class Toernooi
{
  /**
  * @Id
  * @GeneratedValue
  * @Column(type="integer")
  */
  protected $toernooi_id;

  /**
  * @Column(type="string")
  */
  protected $toernooi_naam;

  /**
  * @Column(type="string")
  */
  protected $vereniging_naam;

  /**
  * @Column(type="string", length=6)
  */
  protected $postcode;

  /**
  * @Column(type="datetime")
  */
  protected $start_datum;

  /**
  * @Column(type="datetime")
  */
  protected $eind_datum;

  /**
  * @Column(type="string", length=75)
  */
  protected $organisatie;

  /**
  * @Column(type="boolean")
  */
  protected $goedkeuring;

  /**
  * @Column(type="string", length=15)
  */
  protected $toernooitype;

  /**
  * @Column(type="string", length=1)
  */
  protected $geslacht;

  /**
  * @Column(type="boolean")
  */
  protected $enkel;

  /*
   * @ManyToMany(targetEntity="Registratie\Backend\Entity\Team", mappedBy="toernooien")

  protected $teams;

  function __construct()
  {
    $this->teams = new ArrayCollection();
  }*/

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }
}
 ?>
