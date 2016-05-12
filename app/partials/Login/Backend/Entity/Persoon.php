<?php

namespace Login\Backend\Entity;

/**
 * @Entity @Table(name="Persoon")
 */
class Persoon
{

  /**
  * @Id
  * @Column(type="integer")
  */
  protected $id;


  /**
  * @Column(type="string", length=6)
  */
  protected $postcode;

  /**
  * @Column(type="string")
  */
  protected $vereniging_naam;

  /**
  * @Column(type="string")
  */
  protected $voornaam;

  /**
  * @Column(type="string")
  */
  protected $achternaam;

  /**
  * @Column(type="string", length=1)
  */
  protected $geslacht;

  /**
  * @Column(type="datetime")
  */
  protected $geboortedatum;




  function __construct(argument)
  {

  }
}





 ?>
