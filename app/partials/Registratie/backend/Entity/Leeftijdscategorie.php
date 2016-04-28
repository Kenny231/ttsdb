<?php

namespace Registratie\Backend\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

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
  protected $spelers
}

?>
