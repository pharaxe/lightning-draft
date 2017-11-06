<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    * ORM\Column(type="string", length=100, name="mana_cost")
    */
   private $manaCost;

   /**
    * ORM\Column(type="integer")
    */
   private $cmc;

   /**
    * ORM\Column(type="integer")
    */
   private $power;

   /**
    * ORM\Column(type="integer")
    */
   private $toughness;

   /**
    * ORM\Column(type="string", name="ability")
    */
   private $ability;


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

   public function getCMC() {
      return $this->cmc;
   }

   public function setCMC($cmc) {
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
}
