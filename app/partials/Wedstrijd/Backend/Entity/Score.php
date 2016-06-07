<?php

namespace Wedstrijd\Backend\Entity;

/**
 * @Entity @Table(name="Score")
 */
class Score
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
   * @Id
   * @Column(type="integer")
   */
  protected $wedstrijd_id;

 /**
  * @Id
  * @Column(name="[set]", type="integer")
  */
  protected $set;
 /**
  * @Id
  * @Column(type="integer")
  */
  protected $team_id;
  /**
   * @Column(type="integer")
   */
  protected $punten;

  /**
   * @ManyToOne(targetEntity="Wedstrijd\Backend\Entity\Wedstrijd", inversedBy="score_collection", cascade={"persist"})
   * @JoinColumns({
   *  @JoinColumn(name="toernooi_id", referencedColumnName="toernooi_id"),
   *  @JoinColumn(name="subtoernooi_id", referencedColumnName="subtoernooi_id"),
   *  @JoinColumn(name="wedstrijd_id", referencedColumnName="wedstrijd_id"),
   * })
   */
  protected $wedstrijd;

  /**
   * @OneToOne(targetEntity="Registratie\Backend\Entity\Team", inversedBy="score")
   * @JoinColumn(name="team_id", referencedColumnName="team_id")
   */
  protected $team;

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }
}

?>
