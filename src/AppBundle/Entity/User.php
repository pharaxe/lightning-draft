<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
   /**
    * @ORM\Column(type="integer", name="userid")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   private $id;

   /**
    * @ORM\Column(type="string", length=255)
    */
   private $name;

   /**
    * @ORM\OneToMany(targetEntity="Player", mappedBy="player")
    * @ORM\JoinColumn(name="playerid", referencedColumnName="playerid")
    */
   private $players;


   public function __construct() {
      $this->players = new \Doctrine\Common\Collections\ArrayCollection();
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

   public function getPlayers() {
      return $this->players;
   }
}
