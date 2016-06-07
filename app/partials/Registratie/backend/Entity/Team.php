<?php

namespace Registratie\Backend\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="Team")
 */
class Team
{
  public function __construct() {
    $this->teams = new ArrayCollection();
    $this->spelers = new ArrayCollection();
    $this->toernooien = new ArrayCollection();
    $this->wedstrijd_a_collection = new ArrayCollection();
    $this->wedstrijd_b_collection = new ArrayCollection();
  }
  /**
   * @Id
   * @Column(type="string", length=75)
   */
   protected $team_id;

   /**
    * @Column(type="string")
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
   * @ManyToMany(targetEntity="Toernooi\Backend\Entity\SubToernooi", inversedBy="teams")
   * @JoinTable(name="TeamInSubToernooi",
   *   joinColumns={@JoinColumn(name="team_id", referencedColumnName="team_id")},
   *   inverseJoinColumns={
   *     @JoinColumn(name="toernooi_id", referencedColumnName="toernooi_id"),
   *     @JoinColumn(name="subtoernooi_id", referencedColumnName="subtoernooi_id")
   *   }
   * )
   */
   protected $toernooien;

   /**
    * @OneToMany(targetEntity="Wedstrijd\Backend\Entity\Wedstrijd", mappedBy="team_a", cascade={"persist"})
    */
   protected $wedstrijd_a_collection;

   /**
    * @OneToMany(targetEntity="Wedstrijd\Backend\Entity\Wedstrijd", mappedBy="team_b", cascade={"persist"})
    */
   protected $wedstrijd_b_collection;

   /**
    * @OneToOne(targetEntity="Wedstrijd\Backend\Entity\Score", mappedBy="team", cascade={"persist"})
    */
   protected $score;

   public function __get($property) {
     return $this->$property;
   }

   public function __set($property, $value) {
       $this->$property = $value;
   }
}

?>
