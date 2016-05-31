<?php

namespace Inschrijfadres\Backend\Entity;

/**
 * @Entity @Table(name="Inschrijfadres")
 */
class Inschrijfadres
{

  /**
  * @Id
  * @Column(type="integer")
  */
  protected $toernooi_id;

  /**
  * @Id
  * @Column(type="integer")
  */
  protected $subtoernooi_id;

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
  protected $persoon_id;

  /**
  * @Column(type="decimal", precision=10)
  */
  protected $telefoonnummer;

  /**
  * @Column(type="string", length=100)
  */
  protected $email;

  /**
   * @ManyToOne(targetEntity="Resources\Backend\Entity\Adres", inversedBy="inschrijfadres_collection", cascade={"persist"})
   * @JoinColumns({
   *  @JoinColumn(name="postcode", referencedColumnName="postcode"),
   *  @JoinColumn(name="huisnummer", referencedColumnName="huisnummer")
   * })
   */
  protected $adres;

  /**
   * @OneToOne(targetEntity="Login\Backend\Entity\Werknemer", inversedBy="inschrijfadres")
   * @JoinColumn(name="persoon_id", referencedColumnName="persoon_id")
   */
  protected $werknemer;

  /**
   * @OneToOne(targetEntity="Toernooi\Backend\Entity\SubToernooi", inversedBy="inschrijfadres")
   * @JoinColumns({
   *  @JoinColumn(name="toernooi_id", referencedColumnName="toernooi_id"),
   *  @JoinColumn(name="subtoernooi_id", referencedColumnName="subtoernooi_id")
   * })
   */
  protected $subtoernooi;

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }

}

 ?>
