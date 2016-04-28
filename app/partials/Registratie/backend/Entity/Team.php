<?php

namespace Registratie\Backend\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

class Team
{
  public function __construct() {
    $this->spelers = new ArrayCollection();
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


}

?>
