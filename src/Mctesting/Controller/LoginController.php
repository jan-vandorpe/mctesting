<?php

namespace Mctesting\Controller;
use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;


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
          //$_SESSION["user"] = "eric"; 
          //   $_SESSION["ingelogd"] = true;
             //header("location: /mctesting/home/go");
        //beheerder/admin login
     if($this->isValidEmailFormat($login) || $this->isValidRRNRFormat($login)){
         print("valid");
         if($this->isValidEmailFormat($login)){
             print(" email");             
             $foundUser = $this->getUser($login);
             if ($foundUser == true){
                header("location: /mctesting/home/go");
             }else{
                 print( "could not login with these credentials");
             }
         }else{
             print(" rijksregister");
             $foundTest = $this->getTest($password);
             if($foundTest == true){
                 $magAfleggen = $this->GetTestUser($login, $password);
                         if ($magAfleggen == true){
                             header("location: /mctesting/home/go");
                         }else{
                         print "U heeft geen toegang tot deze test";    
                         }
             }else{
                 print "No test with these credentials";
             }
         }
     }else{
         print("Geen valid login");
     }
     

        
        
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
    
    public function getUser($email) {

        $sql = "select * from gebruikers where email='".$email."'";
        //$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh = new \PDO (DB_DSN, DB_USER, DB_PASS);
        $resultSet = $dbh->query($sql);
        print $email;
        //print " - ".$resultSet." - ";
        print $sql;
        foreach ($resultSet as $rij) {
            //$ingr = new Extra($rij["IngredientId"], $rij["IngredientNaam"], $rij["IngredientPrijs"]);
            print_r($rij);
            //array_push($lijst, $ingr);
        }
        //$rij = $resultSet->fetch();
        //$user = new User($resultSet["rijksregisternr"],$resultSet["email"], $resultSet["voornaam"],$resultSet["familienaam"], $resultSet["gebruikerscategorie"]);
        $dbh = null;
        $user = $rij["voornaam"];
        return $user;
    }
    
    public function getTest($pwd) {

        $sql = "select * from testen where ".$pwd." = wachtwoord";
        //$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh = new \PDO (DB_DSN, DB_USER, DB_PASS);
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch(PDO::FETCH_ASSOC);
        $test = new Test($rij["TestId"]);
        $dbh = null;
        return $test;
    }
    
    
    public function GetTestUser($login, $pwd) {

        $sql = "select * from db where $pwInDB = $loginpw and $testafleggersInDB = $login";
        //$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh = new \PDO (DB_DSN, DB_USER, DB_PASS);
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch(PDO::FETCH_ASSOC);

        $dbh = null;
        return $test;
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
