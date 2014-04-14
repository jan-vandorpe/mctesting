<?php

namespace Mctesting\Controller;
use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\TestService;
use Mctesting\Model\Service\UserService;

/**
 * Description of testscontroller
 * 
 * Controller that handles everything test related
 *
 * @author Bram
 */
class TestsController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function go()
            /**
             * In case of bad redirect, show this
             */
    {
        //model
        $message1 = 'Landingspagina voor alles ivm de tests (hier zou je normaal niet moeten komen)';
        $message2 = "";

        //view
        $this->render('tests.html.twig', array(
            'message1' => $message1,
            'message2' => $message2,

            ));
        //print_r($_SESSION);
        //var_dump($this->app->getUser());
    }
    
    public function testCreation()
            /**
             * 
             */
    {
        //model
        $allTest = TestService::getAll();
        $allUsers = UserService::getAllUsers();
        //view
        $this->render('testcreation.html.twig', array(
            'allTest'=>$allTest,
            'allUsers'=>$allUsers,
            ));
    }
    
    public function testlink()
            /**
             * 
             */
    {
        //model
        if(isset($_SESSION["errormsg"])){
            $message=$_SESSION["errormsg"];
        }else{
            $message="";
        }
        $allTest = TestService::getAll();
        $allUsers = UserService::getAllUsers();
        //view
        $this->render('testlink.html.twig', array(
            'allTest'=>$allTest,
            'allUsers'=>$allUsers,
            'errormsg'=>$message,
            ));
    }
    
    
    public function testlinkadd()
            /**
             * Save created session to DB
             */
    {
        
        $testid=$_POST["testsetselect"];
        if($testid=="0"){
            $_SESSION["errormsg"] = "U moet een test selecteren";
           header("location: /mctesting/tests/testlink");   
           exit(0);
        }
        $datum=$_POST["testdatum"];
        $sessieww=$_POST["testwachtwoord"];
        $actief=1;
        $afgelegd = 0;
        $users = array();
        if(isset($_POST["user"])){$users = $_POST["user"];}
        
        //print_r($_SESSION);
        print("<pre>");
        var_dump($_POST);
        print("</pre>");
            if(TestService::insertCreatedTestSessionIntoDB($datum, $testid, $sessieww, $actief, $users,$afgelegd)){
                //             
            }else{
                //niet gelukt
            }
        
    }
    

    
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }
}
