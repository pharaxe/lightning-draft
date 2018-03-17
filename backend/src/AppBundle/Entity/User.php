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
    * @ORM\Column(type="string", length=36)
    */
   private $uuid;

   /**
    * @ORM\OneToMany(targetEntity="Player", mappedBy="user", cascade={"persist"})
    * @ORM\JoinColumn(name="playerid", referencedColumnName="playerid")
    */
   private $players;


   public function __construct() {
      $this->players = new \Doctrine\Common\Collections\ArrayCollection();
   }

   public function getId() {
      return $this->id;
   }

   public function getUUID() {
      return $this->uuid;
   }

   public function setUUID($uuid) {
      $this->uuid = $uuid;
   }

   public function getPlayers() {
      return $this->players;
   }

   public function addPlayer($player) {
      $this->players->add($player);
   }
}
