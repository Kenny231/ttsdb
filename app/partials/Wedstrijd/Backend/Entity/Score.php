<?php

namespace Wedstrijd\Backend\Controller;

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
   * @Column(type="integer")
   */
  protected $set;
  /**
   * @Id
   * @Column(type="integer")
   */
  protected $team;
  /**
   * @Column(type="integer")
   */
  protected $punten;

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }
}

?>
