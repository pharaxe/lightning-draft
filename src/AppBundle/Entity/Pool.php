<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="pools")
 */
class Pool
{
   /**
    * @ORM\Column(type="integer", name="poolid")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   private $id;

   /**
    * @ORM\OneToMany(targetEntity="Pick", mappedBy="pool", cascade={"persist"})
    * @ORM\JoinColumn(name="poolid", referencedColumnName="poolid")
    */
   private $picks;

   public function __construct() {
      $this->picks = new \Doctrine\Common\Collections\ArrayCollection();
   }

   public function getId() {
      return $this->id;
   }

   public function getPicks() {
      return $this->picks;
   }

   public function addPick($pick) {
      return $this->picks->add($pick);
   }

   public function addArt($art) {
      $pick = new Pick();

      $pick->setPool($this);
      $pick->setArt($art);

      $this->addPick($pick);
   }
}
