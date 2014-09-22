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
 * @author cyber07
 */
class FlashMessageManager {
  
  public function setFlashMessage($msg){
    $message = new Feedback();
    $message->setMessage($msg);
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
