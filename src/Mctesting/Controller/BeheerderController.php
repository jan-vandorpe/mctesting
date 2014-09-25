<?php

namespace Mctesting\Controller;

use Framework\AbstractController;

class BeheerderController extends AbstractController {
    function __construct($app) {
        parent::__construct($app);
    }

    public function go() {
        $this->newBeheerderForm();
    }
    
    public function newBeheerderForm(){
        $this->render('newBeheerderform.html.twig', array());
    }
    
    public function newBeheerder() {
        if (isset($_POST["vnaam"]) && isset($_POST["fnaam"]) && isset($_POST["rrnr"]) && isset($_POST["email"]) && isset($_POST["wachtwoord"])) {
            $user = new User();
            $user->setRRnr($_POST["rrnr"]);
            $user->setFirstName($_POST["vnaam"]);
            $user->setLastName($_POST["fnaam"]);
            $user->setEmail($_POST["email"]);
            $user->setGroup("2");
            $user->setStatus("1");  
            $wachtwoord = $_POST["wachtwoord"];
            $timestamp = date('Y-m-d G:i:s');
            
            if (true) {
                header("location: " . ROOT . "/usermanagement/listusers");
            }
        } else {
            throw new ApplicationException('Gelieve alle vakjes in te vullen');
        }
    }
}
