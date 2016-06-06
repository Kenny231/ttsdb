<?php

namespace Wedstrijd\Backend\Entity;

/**
 * @Entity @Table(name="Wedstrijd")
 */
class Wedstrijd
{

  /**
  * @Id
  * @Column(type="integer")
  */
  protected $wedstrijd_id;

  /**
  * @Id
  * @Column(type="integer")
  */
  protected $subtoernooi_id;

  /**
  * @Id
  * @Column(type="integer")
  */
  protected $toernooi_id;

  /**
  * @Column(type="integer")
  */
  protected $team1;

  /**
  * @Column(type="integer")
  */
  protected $team2;

  /**
  * @Column(type="integer")
  */
  protected $scheidsrechter;

  /**
  * @Column(type="datetime")
  */
  protected $start_datum;

  /**
  * @Column(type="string", length=3)
  */
  protected $poulecode;

  /**
   * @ManyToOne(targetEntity="Toernooi\Backend\Entity\SubToernooi", inversedBy="wedstrijd_collection", cascade={"persist"})
   * @JoinColumns({
   *  @JoinColumn(name="toernooi_id", referencedColumnName="toernooi_id"),
   *  @JoinColumn(name="subtoernooi_id", referencedColumnName="subtoernooi_id")
   * })
   */
  protected $subtoernooi;

  /**
   * @OneToOne(targetEntity="Login\Backend\Entity\Werknemer", inversedBy="wedstrijd")
   * @JoinColumn(name="scheidsrechter", referencedColumnName="persoon_id")
   */
  protected $werknemer;

  /**
   * @ManyToOne(targetEntity="Registratie\Backend\Entity\Team", inversedBy="wedstrijd_a_collection", cascade={"persist"})
   * @JoinColumn(name="team1", referencedColumnName="team_id")
   */
  protected $team_a;

  /**
   * @ManyToOne(targetEntity="Registratie\Backend\Entity\Team", inversedBy="wedstrijd_b_collection", cascade={"persist"})
   * @JoinColumn(name="team2", referencedColumnName="team_id")
   */
  protected $team_b;

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }
}

 ?>
