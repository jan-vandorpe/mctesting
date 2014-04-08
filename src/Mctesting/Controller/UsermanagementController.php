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
 * @author Bram
 * 
 * Beheer van gebruikers die een test willen afleggen (basisgebruikers)
 * 
 */
class UsermanagementController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
//    public function go()
//    {
//        
//    }
    public function newUserForm()
    {
        $this->render('usermanagement.html.twig', array(
           // 'message1' => $message1,

            ));   
    }
    
    public function newUser()
    {
       $firstName = $_POST["vnaam"];
       $lastName = $_POST["fnaam"];
       $RRNr = $_POST["rrnr"];
       
       if(UserService::newUser($firstName, $lastName, $RRNr)){
           header("location: /mctesting/home/listusers");
       }else{
           header("location: /mctesting/home/newuserform");
       }
    }
    
    
    
     
    

        //UserService::loginCheck($login, $password);
        //header("location: /mctesting/home/go");        

    
    
    
    
    
    public function listusers()
    {
        //model
        //$message1 = 'It works!';

        //view
        $this->render('tests.html.twig', array(
          //  'message1' => $message1,

            ));
        //print_r($_SESSION);
        //var_dump($this->app->getUser());
    }

    
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }
}
