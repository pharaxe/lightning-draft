<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;

use AppBundle\Entity\Player;
use \DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="drafts")
 */
class Draft
{
   const STATUS_SETUP = 'setup';
   const STATUS_RUNNING = 'running';
   const STATUS_COMPLETED = 'completed';
   const DECKSIZE_LIMIT = 24;

   /**
    * @ORM\Column(type="integer", name="draftid")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   private $id;

   /**
    * @ORM\Column(type="string", length=255)
    * @JMS\Exclude();
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

   /**
    * @ORM\Column(type="datetime", nullable=true)
    */
   private $start;

   /**
    * @ORM\Column(type="datetime", nullable=true)
    */
   private $finish;

   public function __construct() {
      $this->players = new \Doctrine\Common\Collections\ArrayCollection();
   }

   public function getId() {
      return $this->id;
   }

   public function getStatus() {
      return $this->status;
   }

   public function setStatus($status) {
      $this->status = $status;
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

   /**
    * @return the resulting Player from adding the user to the draft. 
    **/
   public function createPlayer($user) {
      // TODO check to see if user is already in the draft
      $player = new Player();

      $player->setUser($user);
      $player->setDraft($this);

      $this->players->add($player);

      return $player;
   }


   public function getStart() {
      return $this->start;
   }

   public function setStart($time) {
      $this->start = $time;
   }

   public function getFinish() {
      return $this->finish;
   }

   public function setFinish($time) {
      $this->finish = $time;
   }

   public function setStartAsNow() {
      $this->setStart(new DateTime('now'));
   }

   public function setFinishAsNow() {
      $this->setFinish(new DateTime('now'));
   }

}
