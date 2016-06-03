<?php

namespace Toernooi\Backend\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="SubToernooi")
 */
class SubToernooi
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
   * @Column(type="string", length=15)
   */
  protected $categorie_naam;

  /**
   * @Column(type="string", length=1)
   */
  protected $geslacht;

  /**
   * @Column(type="integer")
   */
  protected $enkel;

  /**
   * @OneToOne(targetEntity="Registratie\Backend\Entity\Leeftijdscategorie", inversedBy="subtoernooi", cascade={"persist"})
   * @JoinColumn(name="categorie_naam", referencedColumnName="categorie_naam"),
   */
  protected $leeftijdscategorie;

  /**
   * @OneToOne(targetEntity="Inschrijfadres\Backend\Entity\Inschrijfadres", mappedBy="subtoernooi")
   */
  protected $inschrijfadres;
  /**
   * @ManyToOne(targetEntity="Toernooi\Backend\Entity\Toernooi", inversedBy="subtoernooi_collection", cascade={"persist"})
   * @JoinColumn(name="toernooi_id", referencedColumnName="toernooi_id"),
   */
  protected $toernooi;

  /**
   * @OneToMany(targetEntity="Wedstrijd\Backend\Entity\Wedstrijd", mappedBy="subtoernooi", cascade={"persist"})
   */
  protected $wedstrijd_collection;

  /**
   * @OneToMany(targetEntity="Toernooi\Backend\Entity\Licentie", mappedBy="subtoernooi", cascade={"persist"})
   */
  protected $licentie_collection;

  public function __construct() {
    $this->wedstrijd_collection = new ArrayCollection();
    $this->licentie_collection = new ArrayCollection();
  }

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }
}

?>
