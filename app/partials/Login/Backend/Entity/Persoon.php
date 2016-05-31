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
   * @Column(type="string", length=10)
   */
  protected $huisnummer;

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

  /**
   * @OneToOne(targetEntity="Login\Backend\Entity\Werknemer", mappedBy="persoon")
   */
  protected $werknemer;

  /**
   * @ManyToOne(targetEntity="Resources\Backend\Entity\Adres", inversedBy="persoon_collection", cascade={"persist"})
   * @JoinColumns({
   *  @JoinColumn(name="postcode", referencedColumnName="postcode"),
   *  @JoinColumn(name="huisnummer", referencedColumnName="huisnummer")
   * })
   */
  protected $adres;

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }
}

 ?>
