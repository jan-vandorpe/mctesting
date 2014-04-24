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
        if(UserService::loginCheck($login, $password)){
            header("location: /mctesting/choosesession/choosesession");        
        }else{
            header("location: /mctesting/home/go");        
        }
        
    }
    
    public function logout()
    {
        unset($_SESSION["user"]); 
        unset($_SESSION["testsessions"]); 
        header("location: /mctesting/home/go");

    }

    
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }
}
