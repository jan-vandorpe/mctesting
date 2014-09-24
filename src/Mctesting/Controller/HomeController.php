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

    public function error() {
        $this->render('error.html.twig', array());
    }

    public function feedback($msg = null) {

        switch ($msg[0]) {
            case 'success':
                $message = 'U bent succesvol ingelogd. Nog een prettige dag!';
                break;
            case 'fail':
                $message = 'U heeft een foutief wachtwoord of gebruikersnaam ingevoerd. Probeer opnieuw.';
                break;
            default:
                $message = null;
                break;
        }
        //var_dump($message, $msg);

        $this->render('home.html.twig', array(
            'message' => $message,
        ));
    }

    public function register() {
        //render page
        $this->render('registerUserForm.html.twig', array());
    }

    public function registerUser() {
        if (isset($_POST["vnaam"]) && isset($_POST["fnaam"]) && isset($_POST["rrnr"])) {
            $firstName = $_POST["vnaam"];
            $lastName = $_POST["fnaam"];
            $RRNr = $_POST["rrnr"];
            $timestamp = date('Y-m-d G:i:s');
            if (UserService::validateUser($firstName, $lastName, $RRNr, $timestamp) == true) {
                header("location: " . ROOT . "/home/go");
            }
        } else {
            throw new ApplicationException('Gelieve alle vakjes in te vullen');
        }
    }

}
