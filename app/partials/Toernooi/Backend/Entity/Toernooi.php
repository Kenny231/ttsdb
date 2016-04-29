<?php

namespace Toernooi\Backend\Entity;


use \Doctrine\Common\Collections\ArrayCollection;


class Toernooi
{
  /**
   * @Id
   * @Column(type="integer")
   */
  protected $id;

/**
* @cColumn(type="string")
*/
  protected $vereniging_naam;

  /**
  * @cColumn(type="string", length=6)
  */
  protected $postcode;

  /**
  * @cColumn(type="datetime")
  */
  protected $start_datum;

  /**
  * @cColumn(type="datetime")
  */
  protected $eind_datum;

  /**
  * @cColumn(type="string", length=75)
  */
  protected $organisatie;

  /**
  * @cColumn(type="boolean")
  */
  protected $goedkeuring;


  /**
  * @cColumn(type="datetime")
  */
  protected $aanvangstijdstip;

  /**
  * @cColumn(type="string", length=15)
  */
  protected $toernooitype;

  /**
  * @cColumn(type="string", length=1)
  */
  protected $geslacht;


  /**
  * @cColumn(type="boolean")
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
