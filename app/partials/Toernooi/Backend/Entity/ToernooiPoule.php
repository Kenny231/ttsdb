<?php

namespace Toernooi\Backend\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="ToernooiPoule")
 */
class ToernooiPoule
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
  protected $team_id;

  /**
   * @Id
   * @Column(type="string", length=2)
   */
  protected $poule;

  /**
   * @Column(type="integer")
   */
  protected $wins;

  /**
   * @Column(type="integer")
   */
  protected $position;

  /**
   * @ManyToOne(targetEntity="Toernooi\Backend\Entity\SubToernooi", inversedBy="poule_collection", cascade={"persist"})
   * @JoinColumns({
   *  @JoinColumn(name="toernooi_id", referencedColumnName="toernooi_id"),
   *  @JoinColumn(name="subtoernooi_id", referencedColumnName="subtoernooi_id")
   * }),
   */
  protected $subtoernooi;

  /**
   * @ManyToOne(targetEntity="Registratie\Backend\Entity\Team", inversedBy="poules_collection", cascade={"persist"})
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
