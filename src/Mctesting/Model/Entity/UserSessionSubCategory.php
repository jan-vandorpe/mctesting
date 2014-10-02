<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mctesting\Model\Entity;

/**
 * Description of UserSessionSubCategory
 *
 * @author cyber07
 */
class UserSessionSubCategory extends Subcategory {
  //put your code here
  
 private $score;
 private $percentage;
 private $passPercentage;
 private $maxScore;
 
 public function getMaxScore() {
   return $this->maxScore;
 }

 public function setMaxScore($maxScore) {
   $this->maxScore = $maxScore;
 }

  
 public function getScore() {
   return $this->score;
 }

 public function getPercentage() {
   return $this->percentage;
 }

 public function getPassPercentage() {
   return $this->passPercentage;
 }

 public function setScore($score) {
   $this->score = $score;
 }

 public function setPercentage($percentage) {
   $this->percentage = $percentage;
 }

 public function setPassPercentage($passPercentage) {
   $this->passPercentage = $passPercentage;
 }


}
