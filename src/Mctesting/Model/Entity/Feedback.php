<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mctesting\Model\Entity;

/**
 * Description of Feedback
 *
 * @author cyber07
 */
class Feedback {
  private $message;
  private $class = 0;
  
  public function getClass() {
    return $this->class;
  }

  public function setClass($class) {
    $this->class = $class;
  }

    
  public function getMessage() {
    return $this->message;
  }

  public function setMessage($message) {
    $this->message = $message;
  }


}
