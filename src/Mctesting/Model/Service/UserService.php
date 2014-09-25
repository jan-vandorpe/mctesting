<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Entity\User;
use Mctesting\Model\Entity\TestSession;
use Mctesting\Model\Entity\Test;
use Mctesting\Model\Data\UserDAO;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Includes\FlashMessageManager;

/**
 * Description of UserService
 *
 * @author Thomas Deserranno
 */
class UserService {

    public static function serializeToSession($user) {
        $_SESSION['user'] = serialize($user);
    }

    public static function unserializeFromSession() {
        $user = unserialize($_SESSION['user']);

        return $user;
    }

    public static function getById($id) {
        return UserDAO::selectByRRNr($id);
    }

    public static function getAll() {
        return UserDAO::selectAll();
    }

    public static function getAllUsers() {
        return UserDAO::selectAllBaseUsers();
    }
    
    public static function getAllActiveUsers() {
        return UserDAO::selectAllActiveBaseUsers();
    }
    
    public static function loginCheck($login, $password) {
        if (UserService::isValidEmailFormat($login) || UserService::isValidRRNRFormat($login)) {
            //print("valid");
            if (UserService::isValidEmailFormat($login)) {
                //print(" email");
                //$encryptedPassword = UserService::encryptPassword($password);

                $user = UserDAO::selectByEmail($login, $password);
                UserService::serializeToSession($user);
                return true;
//             $foundUser = UserService::getUser($login);
//             if ($foundUser == true){
//                header("location: ".ROOT."/home/go");
//             }else{
//                 //throw new app exc
//                 print( "could not login with these credentials");
//             }
            } elseif (UserService::isValidRRNRFormat($login)) {
                //print(" rijksregister");
                $user = UserDAO::selectByRRNr($login);
                $sessions = TestSessionService::getSessionByPW($password);
                unset($_SESSION["sessionchoices"]);
                if ($sessions !== null) {
                    foreach ($sessions as $session) {
                        $id = $session->getId();
                        $test = $session->getTest();
                        $name = $test->getTestName();
                        $testid = $test->getTestId();
                        //throw new ApplicationException($id.' and '.$user->getRRnr());
                        if (UserSessionService::getByUserANDSession($id, $user->getRRnr()) !== false) {
                            $sessionUser = UserSessionService::getByUserANDSession($id, $user->getRRnr());
                            $_SESSION["sessionchoices"][$id] = array($testid => $name);
                            $_SESSION["sessionParticipation"][$id] = array("participated" => $sessionUser[0]->getParticipated());
                        }
                    }
                    //$_SESSION["testsessions"]=$sessions;  unused?
                    UserService::serializeToSession($user);
                    return true;
                } else {
                    return false;
                }
//             $foundTest = UserService::getTest($password);
//             if($foundTest == true){
//                 $magAfleggen = UserService::GetTestUser($login, $password);
//                         if ($magAfleggen == true){
//                             header("location: ".ROOT."/home/go");
//                         }else{
//                         print "U heeft geen toegang tot deze test";    
//                         }
//             }else{
//                 print "No test with these credentials";
//             }
            }
        } else {
            throw new ApplicationException('De opgegeven login was foutief. Gelieve een geldig rijksregisternummer of e-mail adres in te voeren');
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
            //Voorlopig in comment voor import CSV fouthandler
            //throw new ApplicationException('Rijksregisternummer is niet correct');
            return false;
        }
        return $result;
    }

    public function encryptPassword($password) {

        //beveilig wachtwoord

        $cost = 10;  //hoe hoger de cost, hoe meer secure maar hoe meer processing power nodig is
        //random salt maken
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');


        // Het wachtwoord prefixen zodat php weet hoe het te verifyen later
        // Beveiliging tegen rainbow tables
        // "$2a$"  betekent dat het blowfish algorithm gebruikt worden
        $salt = sprintf("$2a$%02d$", $cost) . $salt;

        //het wachtwoord hashen met de salt

        $hash = crypt($password, $salt);

        return $hash;
    }

    public function create($firstName, $lastName, $RRNr, $timestamp) {
        //cleanup
        $userGroup = 1;
        if (UserDAO::insert($firstName, $lastName, $RRNr, $userGroup, $timestamp)) {
            return true;
        } else {
            //exception
            return false;
        }
//        }
    }

    public function createCSVuser($firstName, $lastName, $RRNr, $timestamp) {
        //cleanup
        $userGroup = 1;
        if (UserDAO::insertCSVuser($firstName, $lastName, $RRNr, $userGroup, $timestamp)) {
            return true;
        } else {
            //exception
            return false;
        }
//        }
    }

    public static function updateStatus($RRNr, $status) {
        if (UserDAO::updateStatus($RRNr, $status)) {
            return true;
        } else {
            return false;
        }
    }
    public static function updateUser($user) {
        return UserDAO::update($user);
    }
    
    public static function deleteUser($RRNr) {
        if (UserDAO::deleteUser($RRNr)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validateNames($firstName, $lastName) {
        $errors = array();
        $firstName = str_replace(' ', '', $firstName);
        $lastName = str_replace(' ', '', $lastName);
//        if (!ctype_alpha($firstName)) {
//            array_push($errors, 'Voornaam mag enkel letters en koppeltekens bevatten');
//            //throw new ApplicationException('Subcategorienaam mag niet enkel cijfers en leestekens bevatten');
//        }
//        if (!ctype_alpha($lastName)) {
//            array_push($errors, 'Familienaam mag enkel letters en koppeltekens bevatten');
//            //throw new ApplicationException('Subcategorienaam mag niet enkel cijfers en leestekens bevatten');
//        }
        if(strlen($firstName)<1){
          array_push($errors, 'Voornaam moet langer zijn dan 1 letter');
        }
         if(strlen($lastName)<1){
          array_push($errors, 'Familienaam moet langer zijn dan 1 letter');
        }
        //assess errors
        if (empty($errors)) {
            return true;  //set to true for prod
        } else {
            $errormsg = '';
            foreach ($errors as $key => $value) {
                if ($errormsg !== '') {
                    $errormsg .= '<br>';
                }
                $errormsg .= $value;
            }
            throw new ApplicationException($errormsg);
        }
    }

    public function validateUser($firstName, $lastName, $RRNr, $timestamp) {
        if ($firstName !== '' && $lastName !== '' && UserService::isValidRRNRFormat($RRNr) == true && UserService::validateNames($firstName, $lastName) == true) {
            if (UserService::create($firstName, $lastName, $RRNr, $timestamp)) {
                $FMM = new FlashMessageManager();
                $FMM->setFlashMessage('Gebruiker successvol aangemaakt', 1);
                return true;
            }
        } else {
            throw new ApplicationException('Gelieve alle vakjes in te vullen');
        }
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
