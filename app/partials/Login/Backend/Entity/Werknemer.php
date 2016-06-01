<?php

namespace Login\Backend\Entity;

/**
 * @Entity @Table(name="Werknemer")
 */
class Werknemer
{
  /**
  * @Id
  * @Column(type="integer")
  */
  protected $persoon_id;

  /**
   * @Column(type="string", length=75)
   */
  protected $functie_naam;

  /**
   * @OneToOne(targetEntity="Login\Backend\Entity\Persoon", inversedBy="werknemer")
   * @JoinColumn(name="persoon_id", referencedColumnName="persoon_id")
   */
  protected $persoon;

  /**
   * @ManyToOne(targetEntity="Login\Backend\Entity\Functie", inversedBy="werknemer_collection")
   * @JoinColumn(name="functie_naam", referencedColumnName="functie_naam")
   */
  protected $functie;

  /**
   * @OneToOne(targetEntity="Inschrijfadres\Backend\Entity\Inschrijfadres", mappedBy="werknemer")
   */
  protected $inschrijfadres;

  /**
   * @OneToOne(targetEntity="Wedstrijd\Backend\Entity\Wedstrijd", mappedBy="werknemer")
   */
  protected $wedstrijd;

  public function __get($property) {
    return $this->$property;
  }

  public function __set($property, $value) {
      $this->$property = $value;
  }
}

?>
