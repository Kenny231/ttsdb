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
  * @GeneratedValue
  * @Column(type="integer")
  */
  protected $toernooi_id;

  /**
  * @Column(type="string", length=75)
  */
  protected $toernooinaam;

  /**
  * @Column(type="string", length=75)
  */
  protected $vereniging_naam;

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

  /*
   * @ManyToMany(targetEntity="Registratie\Backend\Entity\Team", mappedBy="toernooien")
   */
  protected $teams;

  /**
   * @Column(type="string", length=6)
   */
  protected $postcode;

  /**
   * @Column(type="string", length=10)
   */
  protected $huisnummer;

  /**
   * @Column(type="integer")
   */
  protected $max_aantal_spelers;

  /**
   * @ManyToOne(targetEntity="Resources\Backend\Entity\Adres", inversedBy="toernooi_collection", cascade={"persist"})
   * @JoinColumns({
   *  @JoinColumn(name="postcode", referencedColumnName="postcode"),
   *  @JoinColumn(name="huisnummer", referencedColumnName="huisnummer")
   * })
   */
  protected $adres;

  /**
   * @OneToMany(targetEntity="Toernooi\Backend\Entity\SubToernooi", mappedBy="toernooi", cascade={"persist"})
   */
  protected $subtoernooi_collection;

  function __construct()
  {
    $this->teams = new ArrayCollection();
    $this->subtoernooi_collection = new ArrayCollection();
  }

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }
}
 ?>
