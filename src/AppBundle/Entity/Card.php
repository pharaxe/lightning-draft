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
   private $id

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


   public getId() {
      return $this->id;
   }

   public getName() {
      return $this->name;
   }

   public setName($name) {
      $this->name = $name
   }

   public getManaCost() {
      return $this->manaCost;
   }

   public setManaCost($mana) {
      $this->manaCost = $mana;
   }

   public getCMC() {
      return $this->cmc;
   }

   public setCMC($cmc) {
      $this->cmc = $cmc;
   }

   public getToughness() {
      return $this->toughness;
   }

   public setToughness($tough) {
      $this->toughness = $tough;
   }

   public getPower() {
      return $this->power;
   }

   public setPower($pow) {
      $this->Power = $pow;
   }

   public getAbility() {
      return $this->ability;
   }

   public setAbility($text) {
      $this->ability = $text;
   }

   public getLegendary() {
      return $this->legendary;
   }

   public setLegendary($legendaryFlag) {
      $this->legendary = $legendaryFlag;
   }
}
