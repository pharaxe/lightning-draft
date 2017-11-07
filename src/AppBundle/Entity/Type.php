<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="types")
 */
class Type 
{
   /**
    * @ORM\Column(type="integer", name="typeid")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   private $id;

   /**
    * @ORM\Column(type="string", length=40)
    */
   private $name;


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
}

