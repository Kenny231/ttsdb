<?php

namespace Registratie\Backend\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="Leeftijdscategorie")
 */
class Leeftijdscategorie
{
  public function __construct() {
    $this->spelers = new ArrayCollection();
  }
  /**
   * @Id
   * @Column(type="string", length=15)
   */
  protected $categorie_naam;
  /**
   * @Column(type="integer")
   */
  protected $leeftijd;
  /**
   * @OneToMany(targetEntity="Speler", mappedBy="Leeftijdscategorie")
   */
  protected $spelers;
  /**
   * @OneToMany(targetEntity="Toernooi\Backend\Entity\SubToernooi", mappedBy="leeftijdscategorie", cascade={"persist"})
   */
  protected $toernooi_collection;
}

?>
