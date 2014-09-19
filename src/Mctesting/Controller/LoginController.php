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
class LoginController extends AbstractController
{

    function __construct($app)
    {
        parent::__construct($app);
    }

    public function login()
    {
        $login = $_POST["Login"];
        $password = $_POST["Wachtwoord"];
        if (UserService::isValidEmailFormat($login)) {
            if (UserService::loginCheck($login, $password)) {
                header("location: " . ROOT . "/home/feedback/success");
            } else {
                header("location: " . ROOT . "/home/feedback/fail");
            }
        } else {
            if (UserService::loginCheck($login, $password)) {
                header("location: " . ROOT . "/test/choosesession");
            } else {
                header("location: " . ROOT . "/home/feedback/fail");
            }
        }
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        unset($_SESSION["testsessions"]);
        header("location: " . ROOT . "/home/go");
    }

}
