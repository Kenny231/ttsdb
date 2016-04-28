<?php

namespace Registratie\Backend\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

class Speler
{
  public function __construct() {
    $this->teams = new ArrayCollection();
  }
  /**
   * @Id
   * @Column(type="integer")
   */
  protected $id;
  /**
   * @Column(type="integer")
   */
  protected $klasse;
  /**
   * @Column(type="integer")
   */
  protected $bondsnummer;
  /**
   * @Column(type="string", length=1, options={"fixed" = true})
   */
  protected $licentie;
  /**
   * @Column(type="integer")
   */
  protected $ranking;
  /**
   * @Column(type="string")
   * @ManyToOne(targetEntity="Leeftijdscategorie")
   */
  protected $categorie_naam;
  /**
   * @ManyToMany(targetEntity="Team", mappedBy="spelers")
   */
  protected $teams
}

?>
