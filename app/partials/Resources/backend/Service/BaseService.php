<?php

namespace Resources\Backend\Service;

class BaseService
{
  private $em;
  public function __construct($container) {
    $this->em = $container->em;
  }

  protected function GetEntityManager() {
    return $this->em;
  }

  public function find($entity, $id) {
    return $this->em->getRepository($entity)->find($id);
  }

  public function getList($entity) {
    return $this->em->getRepository($entity)->findAll();
  }

  public function findOneBy($entity, $fields) {
    return $this->em->getRepository($entity)->findOneBy($fields);
  }

  public function persist($entity) {
    $this->em->persist($entity);
    $this->em->flush();
  }

  public function delete($entity, $id) {
    $reference = $this->em->getReference($entity, $id);
    $this->em->remove($reference);
    $this->em->flush();
  }

}

?>
