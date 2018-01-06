<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


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
    */
   private $id;

   /**
    * @ORM\Column(type="integer", name="`order`")
    */
   private $order;

   /**
    * @ORM\ManyToOne(targetEntity="Art", inversedBy="pick", cascade="persist")
    * @ORM\JoinColumn(name="artid", referencedColumnName="artid")
    */
   private $art;

   /**
    * @ORM\ManyToOne(targetEntity="Pool", inversedBy="pick", cascade={"all"})
    * @ORM\JoinColumn(name="poolid", referencedColumnName="poolid")
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
      return $this->pool = $pool;
   }
}
