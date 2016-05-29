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


  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }

}

 ?>
