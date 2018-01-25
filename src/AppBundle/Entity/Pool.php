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
    * @ORM\Column(type="boolean", name="ordered")
    */
   private $ordered = TRUE;

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

   public function getOrdered() {
      return $this->ordered;
   }

   public function getPicks() {
      return $this->picks;
   }

   public function isEmpty() {
      return $this->picks->isEmpty();
   }

   public function getCount() {
      return $this->picks->count();
   }

   public function getNextOrder() {
      return $this->getCount() + 1;
   }

   public function addPick($pick) {
      if ($this->getOrdered()) {
         $pick->setOrder($this->getNextOrder());
      }

      $pick->setPool($this);
      return $this->picks->add($pick);
   }

   // take all the picks from one pool and change them to be in this one.
   public function addPool($poolToAdd) {
      $picksToAbsorb = $poolToAdd->getPicks();

      foreach ($picksToAbsorb as $newPick) {
         $this->addPick($newPick);
      }
   }

   public function addCards($cards) {
      foreach ($cards as $card) {
         $this->addArt($card->getMiddleArt());
      }
   }

   public function addArt($art) {
      $pick = new Pick();
      $pick->setArt($art);

      $this->addPick($pick);
   }
}
