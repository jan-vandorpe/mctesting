<?php

namespace Mctesting\Controller;
use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;

/**
 * Description of homecontroller
 * 
 * Controller that shows the application homepage.
 *
 * @author Thomas
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
          //$_SESSION["user"] = "eric"; 
          //   $_SESSION["ingelogd"] = true;
             //header("location: /mctesting/home/go");
        //beheerder/admin login
     if($this->isValidEmailFormat($login) || $this->isValidRRNRFormat($login)){
         print("valid");
         if($this->isValidEmailFormat($login)){
             print(" email");
         }else{
             print(" rijksregister");
         }
     }else{
         print("Geen valid login");
     }
       //if(isValidEmailFormat($login)){       
            //$found = select * from db where $login = usernameInDB
            //if ($found = true){
                //if ($loginpw == $pwInDB){
                    //header location = menu.html
                //}else{
                    //error: "could not login with these credentials";
                //}
            //}else{
                //error: "could not login with these credentials"; || error: "user does not exist";
            //}
            
       //testafnemer login
       //}else{
        //$test = select * from db where $loginpw = $pwInDB
        //if($test == true){
            //$magAfleggen = select * from db where $pwInDB = $loginpw and $testafleggersInDB = $login
            //if ($magAfleggen == true){
                //header location = menu.html
            //}else{
            //error: "U heeft geen toegang tot deze test";
            //}
        
        //}else{
            //error: "No test with these credentials";
        //}       
       //}
    //error: "Controlleer de gegevens.";
    //}         

        
        
    }
    public function isValidEmailFormat($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) 
        && preg_match('/@.+\./', $email);
    }
    
    public function isValidRRNRFormat($rijksregisterNr) {
        //cleanup
        $rijksregisterNr = preg_replace('/[^0-9]/',"",$rijksregisterNr);
       
        if(preg_match('/^\d{11}$/', $rijksregisterNr)){
            $result = true;
            return $result;
        }else{
            $result = false;
            return $result;
        }
        return $result;
    }
    
    
    public function logout()
    {
      unset($_SESSION["user"]); 
       unset($_SESSION["ingelogd"]);
       header("location: /mctesting/home/go");

    }

    
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }
}
