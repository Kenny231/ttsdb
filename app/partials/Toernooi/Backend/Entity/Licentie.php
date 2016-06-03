<?php

namespace Toernooi\Backend\Entity;

/**
 * @Entity @Table(name="Licentie")
 */
class Licentie
{
  /**
   * @Id
   * @Column(type="string", length = 1)
   */
  protected $licentie;
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
   * @ManyToOne(targetEntity="Toernooi\Backend\Entity\SubToernooi", inversedBy="licentie_collection", cascade={"persist"})
   * @JoinColumns({
   *  @JoinColumn(name="toernooi_id", referencedColumnName="toernooi_id"),
   *  @JoinColumn(name="subtoernooi_id", referencedColumnName="subtoernooi_id")
   * })
   */
  protected $subtoernooi;
}

?>
