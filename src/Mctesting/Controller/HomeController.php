<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\UserService;

/**
 * Description of homecontroller
 * 
 * Controller that shows the application homepage.
 *
 * @author Bram & Thomas
 */
class HomeController extends AbstractController {

    function __construct($app) {
        parent::__construct($app);
    }

    public function go() {
        //render page
        $this->render('home.html.twig', array());
    }

    public function register() {
        //render page
        $this->render('registerUserForm.html.twig', array());
    }

    public function registerUser() {
        $firstName = $_POST["vnaam"];
        $lastName = $_POST["fnaam"];
        $RRNr = $_POST["rrnr"];
        $status = 0;
        if ($firstName !== null and $lastName !== null and UserService::isValidRRNRFormat($RRNr) == true) {
            if (UserService::create($firstName, $lastName, $RRNr, $status)) {
                header("location: " . ROOT . "/home/go");
            } else {
                //header("location: ".ROOT."/home/newuserform");
                //echo("lolz");
            }
        } else {
            print ("Niet valid.");
        }
    }

}
