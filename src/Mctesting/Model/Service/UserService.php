<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Entity\User;
use Mctesting\Model\Entity\TestSession;
use Mctesting\Model\Data\UserDAO;

/**
 * Description of UserService
 *
 * @author Thomas Deserranno
 */
class UserService
{
    public static function serializeToSession($user)
    {
        $_SESSION['user'] = serialize($user);
    }
    
    public static function unserializeFromSession()
    {
        $user = unserialize($_SESSION['user']);
        
        return $user;
    }
    
    public static function getById($id)
    {
        return UserDAO::selectByRRNr($id);
    }
    
    public static function getAll()
    {
        return UserDAO::selectAll();
    }
    
    public static function getAllUsers()
    {
        return UserDAO::selectAllBaseUsers();
    }
    
    public static function loginCheck($login, $password)
    {
        if(UserService::isValidEmailFormat($login) || UserService::isValidRRNRFormat($login)){
         //print("valid");
         if(UserService::isValidEmailFormat($login)){
             //print(" email");   
             $user = UserDAO::selectByEmail($login, $password);
             UserService::serializeToSession($user);
             return true;
//             $foundUser = UserService::getUser($login);
//             if ($foundUser == true){
//                header("location: /mctesting/home/go");
//             }else{
//                 //throw new app exc
//                 print( "could not login with these credentials");
//             }
         }else{
             //print(" rijksregister");
             $user = UserDAO::selectByRRNr($login);
             $session=(TestSessionService::getSessionByPW($password));
             $sessionId=$session->getId();
             if(UserSessionService::getUserSession($sessionId, $login)){
                UserService::serializeToSession($user);
                return true;
             }
//             $foundTest = UserService::getTest($password);
//             if($foundTest == true){
//                 $magAfleggen = UserService::GetTestUser($login, $password);
//                         if ($magAfleggen == true){
//                             header("location: /mctesting/home/go");
//                         }else{
//                         print "U heeft geen toegang tot deze test";    
//                         }
//             }else{
//                 print "No test with these credentials";
//             }
         }
     }else{
         print("Geen valid login");
         return false;
     }
    }
    
    
    
    
//    public static function getUser($login, $password) {
//        if (isValidEmail($login)) {
//            selectByEmail($login, $password);
//            return $user;
//        } else {
//            if (isValidRRNr($login)) {
//                selectByRRNr($login);
//                return $user;
//            }
//        }
//    }

    public function isValidEmailFormat($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
    }

    public function isValidRRNRFormat($rijksregisterNr) {
        //cleanup
        $rijksregisterNr = preg_replace('/[^0-9]/', "", $rijksregisterNr);

        if (preg_match('/^\d{11}$/', $rijksregisterNr)) {
            $result = true;
            return $result;
        } else {
            $result = false;
            return $result;
        }
        return $result;
    }
    
    
    
    public function createTestUser($firstName, $lastName, $RRNr) {
        //cleanup
        $userGroup = 1;
            if(UserDAO::insert($firstName, $lastName, $RRNr, $userGroup)){
                return true;
            }else{
                //exception
                return false;
            }
//        }
    }
    
    
    
    
    
    
    
    
    
//    public function getUser($email) {
//
//        $sql = "select * from gebruikers where email='".$email."'";
//        //$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
//        $dbh = new \PDO (DB_DSN, DB_USER, DB_PASS);
//        $resultSet = $dbh->query($sql);
//        print $email;
//        //print " - ".$resultSet." - ";
//        print $sql;
//        foreach ($resultSet as $rij) {
//            //$ingr = new Extra($rij["IngredientId"], $rij["IngredientNaam"], $rij["IngredientPrijs"]);
//            print_r($rij);
//            //array_push($lijst, $ingr);
//        }
//        //$rij = $resultSet->fetch();
//        //$user = new User($resultSet["rijksregisternr"],$resultSet["email"], $resultSet["voornaam"],$resultSet["familienaam"], $resultSet["gebruikerscategorie"]);
//        $dbh = null;
//        $user = $rij["voornaam"];
//        return $user;
//    }
//    
//    public function getTest($pwd) {
//
//        $sql = "select * from testen where ".$pwd." = wachtwoord";
//        //$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
//        $dbh = new \PDO (DB_DSN, DB_USER, DB_PASS);
//        $resultSet = $dbh->query($sql);
//        $rij = $resultSet->fetch(PDO::FETCH_ASSOC);
//        $test = new Test($rij["TestId"]);
//        $dbh = null;
//        return $test;
//    }
//    
//    
//    public function GetTestUser($login, $pwd) {
//
//        $sql = "select * from db where $pwInDB = $loginpw and $testafleggersInDB = $login";
//        //$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
//        $dbh = new \PDO (DB_DSN, DB_USER, DB_PASS);
//        $resultSet = $dbh->query($sql);
//        $rij = $resultSet->fetch(PDO::FETCH_ASSOC);
//
//        $dbh = null;
//        return $test;
//    }
    
    
}