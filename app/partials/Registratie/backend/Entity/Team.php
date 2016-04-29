<?php

namespace Registratie\Backend\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

class Team
{
  public function __construct() {
    $this->spelers = new ArrayCollection();
    $this->toernooien = new ArrayCollection();
  }
  /**
   * @Id
   * @Column(type="string", length=75)
   */
   protected $team_naam;
   /**
   * @ManyToMany(targetEntity="Speler", inversedBy="teams")
   * @JoinTable(name="SpelerInTeam",
   *   joinColumns={@JoinColumn(name="team_naam", referencedColumnName="team_naam")},
   *   inverseJoinColumns={@JoinColumn(name="persoon_id", referencedColumnName="persoon_id")}
   * )
   */
   protected $spelers;

   /**
   * @ManyToMany(targetEntity="Toernooi", inversedBy="teams")
   * @JoinTable(name="TeamInToernooi",
   *   joinColumns={@JoinColumn(name="team_naam", referencedColumnName="team_naam")},
   *   inverseJoinColumns={@JoinColumn(name="toernooi_id", referencedColumnName="toernooi_id")}
   * )
   */
   protected $toernooien;


}

?>
