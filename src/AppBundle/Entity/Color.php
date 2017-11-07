<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="colors")
 */
class Color 
{
   /**
    * @ORM\Column(type="integer", name="colorid")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   private $id;

   /**
    * @ORM\Column(type="string", length=40)
    */
   private $name;

   /**
    * @ORM\Column(type="string", length=1)
    */
   private $symbol;


   public function getId() 
   {
      return $id;
   }

   public function setName($name) 
   {
      $this->name = $name;
   }

   public function getName() 
   {
      return $this->name;
   }

   public function getSymbol() 
   {
      return $this->symbol;
   }

   public function setSymbol($letter) 
   {
      $this->symbol = $letter;
   }
}
