<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;

use AppBundle\Entity\Art;

/**
 * @ORM\Entity
 * @ORM\Table(name="cards")
 */
class Card
{
   /**
    * @ORM\Column(type="integer", name="cardid")
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
   private $type_text;

   /**
    * @ORM\Column(type="string", length=100, name="mana_cost")
    */
   private $manaCost;

   /**
    * @ORM\Column(type="integer")
    */
   private $cmc;

   /**
    * @ORM\Column(type="integer")
    */
   private $power;

   /**
    * @ORM\Column(type="integer")
    */
   private $toughness;

   /**
    * @ORM\Column(type="text", name="ability")
    */
   private $ability;

   /**
    * @ORM\ManyToMany(targetEntity="Color", cascade={"persist"})
    * @ORM\JoinTable(name="cards_colors",
    *    joinColumns={@ORM\JoinColumn(name="cardid", referencedColumnName="cardid")},
    *    inverseJoinColumns={@ORM\JoinColumn(name="colorid", referencedColumnName="colorid")}
    *    )
    */
   private $colors;

   /**
    * @ORM\ManyToMany(targetEntity="Type", cascade={"persist"})
    * @ORM\JoinTable(name="cards_types",
    *    joinColumns={@ORM\JoinColumn(name="cardid", referencedColumnName="cardid")},
    *    inverseJoinColumns={@ORM\JoinColumn(name="typeid", referencedColumnName="typeid")}
    *    )
    * @JMS\Exclude();
    */
   private $types;

   /**
    * @ORM\ManyToMany(targetEntity="Color", cascade={"persist"})
    * @ORM\JoinTable(name="cards_identities",
    *    joinColumns={@ORM\JoinColumn(name="cardid", referencedColumnName="cardid")},
    *    inverseJoinColumns={@ORM\JoinColumn(name="colorid", referencedColumnName="colorid")}
    *    )
    * @JMS\Exclude();
    */
   private $identities;

   /**
    * @ORM\OneToMany(targetEntity="Art", mappedBy="card")
    * @JMS\Exclude();
    */
   private $arts;


   public function __construct() {
      $this->colors = new \Doctrine\Common\Collections\ArrayCollection();
      $this->types = new \Doctrine\Common\Collections\ArrayCollection();
      $this->identities = new \Doctrine\Common\Collections\ArrayCollection();
      $this->arts = new ArrayCollection();
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

   public function getManaCost() {
      return $this->manaCost;
   }

   public function setManaCost($mana) {
      $this->manaCost = $mana;
   }

   public function getCmc() {
      if ($this->isLand()) {
         return $this->cmc - 1; // super big hack

      }

      return $this->cmc;
   }

   public function setCmc($cmc) {
      $this->cmc = $cmc;
   }

   public function getToughness() {
      return $this->toughness;
   }

   public function setToughness($tough) {
      $this->toughness = $tough;
   }

   public function getPower() {
      return $this->power;
   }

   public function setPower($pow) {
      $this->Power = $pow;
   }

   public function getAbility() {
      return $this->ability;
   }

   public function setAbility($text) {
      $this->ability = $text;
   }

   public function getLegendary() {
      return $this->legendary;
   }

   public function setLegendary($legendaryFlag) {
      $this->legendary = $legendaryFlag;
   }

   public function addColor($color) {
      if (!$this->colors->contains($color)) {
         $this->colors->add($color);
      }
   }

   public function addIdentity($color) {
      if (!$this->identities->contains($color)) {
         $this->identities->add($color);
      }
   }

   public function addType($type) {
      if (!$this->types->contains($type)) {
         $this->types->add($type);
      }
   }

   public function getColors() {
      return $this->colors;
   }

   public function getIdentities() {
      return $this->identities;
   }
   public function getTypes() {
      return $this->types;
   }

   public function addArt($art) {
      $this->arts->add($art);
   }

   public function getArts() {
      return $this->arts;
   }

   public function getMiddleArt() {
      $numberOfPrintings = count($this->getArts());

      $middle = (int) ceil($numberOfPrintings / 2);

      $artArray = $this->getArts()->toArray();
      $sortedByDate = usort($artArray, array("AppBundle\Entity\Art", "SortByReleaseDate"));

      return $artArray[max(0, $middle - 1)];
   }

   /**
    * @JMS\VirtualProperty()
    */
   public function getUrl() {
      $art = $this->getMiddleArt();

      return 'https://img.lightningdraft.online/' . $art->getMultiverseid() . '.jpg';
   }

   /**
    * @JMS\Exclude();
    */
   public function getTypeText() {
      return $this->type_text;
   }

   public function setTypeText($text) {
      $this->type_text = $text;
   }

   public function isLand() {
      foreach ($this->getTypes() as $type) {
         if ($type->getName() === 'land')
            return true;
      }
      return false;
   }

   public static function sortByCmc($n1, $n2) {
      if ($n1->getCmc() == $n2->getCmc() )  {
         // lands come first
         return 0;
      }

      return ($n1->getCmc() > $n2->getCmc()) ? +1 : -1;
   } 
}
