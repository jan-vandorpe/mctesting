<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mctesting\Model\Includes;

use Mctesting\Model\Entity\Feedback;

/**
 * Description of FlashMessageManager
 * Serializes messages to the the session, which then get deleted after one redirect
 * deletion triggers in index.php
 *
 * $message = string, message to be displayed
 * $class = int: 0 for error message, 1 for success message
 * 
 * @author cyber07
 */
class FlashMessageManager {
  
  public function setFlashMessage($msg, $class = 0){
    $message = new Feedback();
    $message->setMessage($msg);
    $message->setClass($class);
    $_SESSION['feedback'] = serialize($message);
  }
  
  public function getFlashMessage(){
    $message = unserialize($_SESSION['feedback']);
    return $message;
  }
  
  public function unsetFlashMessage(){
    unset($_SESSION['feedback']);
  }
  
}
