<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="drafts")
 */
class Draft
{
   /**
    * @ORM\Column(type="integer", name="draftid")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   private $id;

   /**
    * @ORM\Column(type="string", length=255)
    */
   private $name;

   /**
    * @ORM\Column(type="string", length=255)
    */
   private $status;

   /**
    * @ORM\OneToMany(targetEntity="Player", mappedBy="draft", cascade={"persist"})
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

   public function addPlayer($user) {
      $player = new Player();

      $player->setUser($user);
      $player->setDraft($this);

      $this->players->add($player);
   }
}
