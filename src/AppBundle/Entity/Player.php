<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="players")
 */
class Player
{
   /**
    * @ORM\Column(type="integer", name="playerid")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   private $id;

   /**
    * @ORM\Column(type="string", length=255)
    */
   private $name;

   /**
    * @ORM\ManyToOne(targetEntity="Draft", inversedBy="player")
    * @JoinColumn(name="draftid", referencedColumnName="draftid")
    */
   private $draft;

   /**
    * @ORM\ManyToOne(targetEntity="User", inversedBy="player")
    * @JoinColumn(name="userid", referencedColumnName="userid")
    */
   private $user;

   /**
    * @ORM\OneToOne(targetEntity="Pool", mappedBy="player")
    * @JoinColumn(name="poolid", referencedColumnName="poolid")
    */
   private $pool;

   public function __construct() {
      $this->pool = new Pool();
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

   public function getPool() {
      return $this->pool;
   }

   public function draftArt($art) {
      $this->pool->addArt($art);
   }

   public function getUser() {
      return $user;
   }

   public function setUser($user) {
      $this->user = $user;
   }

   public function getDraft() {
      return $this->draft;
   }

   public function setDraft($draft) {
      $this->draft = $draft;
   }
}
