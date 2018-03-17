<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;


/**
 * @ORM\Entity
 * @ORM\Table(name="picks")
 */
class Pick
{
   /**
    * @ORM\Column(type="integer", name="pickid")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @JMS\Exclude();
    */
   private $id;

   /**
    * @ORM\Column(type="integer", name="`order`")
    * @JMS\Exclude();
    */
   private $order;

   /**
    * @ORM\ManyToOne(targetEntity="Art", cascade="persist")
    * @ORM\JoinColumn(name="artid", referencedColumnName="artid")
    */
   private $art;

   /**
    * @ORM\ManyToOne(targetEntity="Pool", inversedBy="picks", cascade={"all"})
    * @ORM\JoinColumn(name="poolid", referencedColumnName="poolid")
    * @JMS\Exclude();
    */
   private $pool;


   public function __construct() {

   }

   public function getId() {
      return $this->id;
   }

   public function getName() {
      return $this->name;
   }

   public function setName($name) {
      $this->name = $name;
   }

   public function getOrder() {
      return $this->order;
   }

   public function setOrder($order) {
      $this->order = $order;
   }

   public function getArt() {
      return $this->art;
   }

   public function setArt($art) {
      return $this->art = $art;
   }

   public function getPool() {
      return $this->pool;
   }

   public function setPool($pool) {
      // if pick was in another pool, remove it from the arraycollection.
      if ($this->getPool()) {
         $this->getPool()->removePick($this);

      }
      return $this->pool = $pool;
   }

   // TODO table inheritence would solve needing to repeat this function.
   // I really shouldn't be sorting this often either.
   public static function sortByCmc($n1, $n2) {
      $n1 = $n1->getArt()->getCard();
      $n2 = $n2->getArt()->getCard();

      $n1cmc = $n1->getCmc();
      $n2cmc = $n2->getCmc();

      if ($n1->isLand()) {
         $n1cmc = -1;
      }

      if ($n2->isLand()) {
         $n2cmc = -1;
      }

      if (strpos($n1->getManaCost(), 'X') && $n1cmc != 0) { // nonartifact X spells should sort high
         $n1cmc += 8;
      }
      if (strpos($n2->getManaCost(), 'X') && $n2cmc != 0) { 
         $n2cmc += 8;
      }

      return ($n1cmc > $n2cmc) ? +1 : -1;
   } 
}
