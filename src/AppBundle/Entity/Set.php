<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrin\Coommon\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="sets")
 */
class Set
{
   /**
    * @ORM\Column(type="integer", name="setid")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   private $id;

   /**
    * @ORM\Column(type="string", length=255)
    */
   private $name;

   /**
    * @ORM\Column(type="string", length=10)
    */
   private $code;

   /**
    * @ORM\Column(type="date", name="release_date")
    */
   private $releaseDate;

   public function setName($name) {
      $this->name = $name;
   }

   public function getName() {
      return $this->name;
   }

   public function setCode($code) {
      $this->code = $code;
   }

   public function getCode() {
      return $this->code;
   }

   public function setReleaseDate($date) {
      $this->releaseDate = $date;
   }

   public function getReleaseDate() {
      return $this->releaseDate;
   }

   public function getId() {
      return $this->id;
   }
}
