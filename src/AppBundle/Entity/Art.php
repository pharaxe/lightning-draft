<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrin\Coommon\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 * @ORM\Table(name="arts")
 */
class Art
{
   /**
    * @ORM\Column(type="integer", name="artid")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   private $id;

   /**
    * @ORM\Column(type="string", length=255)
    * @JMS\Exclude();
    */
   private $artist;

   /**
    * @ORM\Column(type="string", length=255)
    * @JMS\Exclude();
    */
   private $url;

   /**
    * @ORM\Column(type="string", length=255)
    */
   private $rarity;

   /**
    * @ORM\Column(type="integer")
    */
   private $multiverseid;

   /**
    * @ORM\ManyToOne(targetEntity="Card", inversedBy="arts", cascade="persist")
    * @ORM\JoinColumn(name="cardid", referencedColumnName="cardid")
    */
   private $card;

   /**
    * @ORM\ManyToOne(targetEntity="Set", inversedBy="arts", cascade="persist")
    * @ORM\JoinColumn(name="setid", referencedColumnName="setid")
    * @JMS\Exclude();
    */
   private $set;

   public function getId() {
      return $this->id;
   }

   public function getArtist() {
      return $this->artist;
   }

   public function setArtist($artistName) {
      $this->artist = $artistName;
   }

   public function getUrl() {
      return $this->url;
   }

   public function setUrl($url) {
      $this->url = $url;
   }

   public function getRarity() {
      return $this->rarity;
   }

   public function setRarity($rarity) {
      $this->rarity = $rarity;
   }

   public function setMultiverseid($multiverseid) {
      $this->multiverseid = $multiverseid;
   }

   public function getMultiverseid() {
      return $this->multiverseid;
   }

   public function getCard() {
      return $this->card;
   }

   public function setCard($card) {
      $this->card = $card;
   }

   public function getSet() {
      return $this->set;
   }

   public function setSet($set) {
      $this->set = $set;
   }

   public function getFullURL() {
      return "http://bensweedler.com/art/" . $this->getMultiverseid() . ".jpg";
   }

   public static function SortByReleaseDate($a, $b) {
      return ($a->getSet()->getReleaseDate() > $b->getSet()->getReleaseDate()) ? +1 : -1;
   }
}
