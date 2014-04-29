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
    
    public function go()
    {
        $this->render('usermanagement.html.twig', array(
           // 'message1' => $message1,

            ));   
      
    }
    public function newUserForm()
    {
        $this->render('newuserform.html.twig', array(
           // 'message1' => $message1,

            ));   
    }
    
    public function newUser()
    {
       $firstName = $_POST["vnaam"];
       $lastName = $_POST["fnaam"];
       $RRNr = $_POST["rrnr"];
       
       if($firstName !== null and $lastName !== null and UserService::isValidRRNRFormat($RRNr) == true){
            if(UserService::create($firstName, $lastName, $RRNr)){
                header("location: ".ROOT."/usermanagement/listusers");
            }else{
                //header("location: ".ROOT."/home/newuserform");
                //echo("lolz");
            }           
       }else{
          print ("Niet valid."); 
       }       
    }
    
    
    
     
    

        //UserService::loginCheck($login, $password);
        //header("location: ".ROOT."/home/go");        

    
    
    
    
    
    public function listusers()
    {
        //model
        //$message1 = 'It works!';
        $allUsers = UserService::getAllUsers();
        
        
        //view
        $this->render('userlist.html.twig', array(
          //  'message1' => $message1,
            'allUsers'=>$allUsers,

            ));
        //print_r($_SESSION);
        //var_dump($this->app->getUser());
    }

    
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }
}
