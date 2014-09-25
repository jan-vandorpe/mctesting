<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\BeheerderService;
use Mctesting\Model\Entity\User;
use Mctesting\Model\Includes\FlashMessageManager;

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
        if (isset($_POST["vnaam"]) && isset($_POST["fnaam"]) && isset($_POST["rrnr"]) && isset($_POST["email"])) {
            $user = new User();
            $user->setRRnr($_POST["rrnr"]);
            $user->setFirstName($_POST["vnaam"]);
            $user->setLastName($_POST["fnaam"]);
            $user->setEmail($_POST["email"]);
            $user->setGroup(2);
            
            if (BeheerderService::registerBeheerder($user)) {
                $FMM = new FlashMessageManager();
                $FMM->setFlashMessage('Beheerder succesvol aangepast', 1);
                header("location: " . ROOT . "/beheerder/newBeheerderForm/");
            }
        } else {
            throw new ApplicationException('Gelieve alle vakjes in te vullen');
        }
    }
}
