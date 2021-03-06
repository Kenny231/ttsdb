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
   * @OneToOne(targetEntity="Toernooi\Backend\Entity\SubToernooi", mappedBy="leeftijdscategorie", cascade={"persist"})
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
