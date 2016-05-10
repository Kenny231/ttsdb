<?php

namespace Toernooi\Backend\Entity;


use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="Toernooi")
 */
class Toernooi
{
  /**
  * @Id
  * @Column(type="integer")
  */
  protected $id;

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
  * @Column(type="datetime")
  */
  protected $aanvangstijdstip;

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

  /**
   * @ManyToMany(targetEntity="Team", mappedBy="toernooien")
   */
  protected $teams

  function __construct()
  {
    $this->teams = new ArrayCollection();
  }
}
 ?>
