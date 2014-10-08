<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\User;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\UsergroupService;

class UserDAO {

    public static function selectAll() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikers ORDER BY familienaam';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create usergroup object
                    $user = new User();
                    $user->setRRnr($record['rijksregisternr']);
                    $user->setFirstName($record['email']);
                    $user->setLastName($record['voornaam']);
                    $user->setEmail($record['familienaam']);
                    $user->setGroup($record['gebruikerstype']);
                    $user->setStatus($record['actief']);
                    
                    array_push($result, $user);
                }
                return $result;
            } else {
                throw new ApplicationException('Er zijn geen gebruikers gevonden');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De gebruikers konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectAllBaseUsers() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikers where gebruikerstype = 1 ORDER BY familienaam';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create usergroup object
                    $user = new User();
                    $user->setRRnr($record['rijksregisternr']);
                    $user->setFirstName($record['voornaam']);
                    $user->setLastName($record['familienaam']);
                    $user->setEmail($record['email']);
                    $user->setGroup($record['gebruikerstype']);
                    $user->setStatus($record['actief']);

                    array_push($result, $user);
                }
                return $result;
            } else {
                return false;
                //throw new ApplicationException('Er zijn geen gebruikers gevonden');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De gebruikers konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }
    
    public static function selectAllActiveBaseUsers() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikers where gebruikerstype = 1 AND actief = 1 ORDER BY familienaam';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create usergroup object
                    $user = new User();
                    $user->setRRnr($record['rijksregisternr']);
                    $user->setFirstName($record['voornaam']);
                    $user->setLastName($record['familienaam']);
                    $user->setEmail($record['email']);
                    $user->setGroup($record['gebruikerstype']);
                    $user->setStatus($record['actief']);

                    array_push($result, $user);
                }
                return $result;
            } else {
                return false;
                //throw new ApplicationException('Er zijn geen gebruikers gevonden');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De gebruikers konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectByEmail($email, $password) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikers WHERE email = :email and actief = 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':email' => $email))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //test if password matches encrypted hash
                if (crypt($password, $record['wachtwoord']) == $record['wachtwoord']) {
                    //create object(s) and return
                    //create usergroup
                    $group = UsergroupService::getById($record['gebruikerstype']);
                    //create  object
                    $user = new User();
                    $user->setRRnr($record['rijksregisternr']);
                    $user->setFirstName($record['voornaam']);
                    $user->setLastName($record['familienaam']);
                    $user->setEmail($record['email']);
                    $user->setGroup($group);
                    return $user;
                } else {
                    throw new ApplicationException('Wachtwoord is incorrect');
                }
            } else {
                throw new ApplicationException('Er zijn geen gebruikers gevonden met het email (' . $email . ')');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De gebruikers met het email (' . $email . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectByRRNr($rrnr) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikers WHERE rijksregisternr = :rrnr';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':rrnr' => $rrnr))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                //create usergroup
                $group = UsergroupService::getById($record['gebruikerstype']);
                //create  user
                $user = new User();
                $user->setRRnr($record['rijksregisternr']);
                $user->setFirstName($record['voornaam']);
                $user->setLastName($record['familienaam']);
                $user->setEmail($record['email']);
                $user->setGroup($group);
                return $user;
            } else {
                //CSV controlleerd als gebruikers als aanwezig zijn in database,
                //Deze error gecomment anders wordt hij weergegeven en worden gebruikers 
                //niet aan de database toegevoegd.
                //throw new ApplicationException('Geen gebruiker gevonden met dit rijksregisternummer.');
                return false;
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De gebruikers met het rrnr (' . $rrnr . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function insert($firstName, $lastName, $RRNr, $userGroup, $timestamp) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `gebruikers`(`rijksregisternr`, `voornaam`, `familienaam`,`gebruikerstype`, `toegevoegd`) VALUES (:RRNr , :firstName , :lastName , :group, :timestamp)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':RRNr' => $RRNr, ':firstName' => $firstName, ':lastName' => $lastName, ':group' => $userGroup, ':timestamp' => $timestamp))) {
            //test if statement succes
            return true;
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            if ($error[1] == 1062){
                throw new ApplicationException('De gebruiker ('.$RRNr.') bestaat al');
            }else{
                throw new ApplicationException('Kon geen gebruiker in de database invoeren, gelieve dit te controleren:<br>'.$error[2]);
            }
            //header("location: /mctesting/agga/dagga");
        }
    }

    public static function insertCSVuser($firstName, $lastName, $RRNr, $userGroup, $timestamp) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `gebruikers`(`rijksregisternr`, `voornaam`, `familienaam`,`gebruikerstype`, `toegevoegd`) VALUES (:RRNr , :firstName , :lastName , :group, :timestamp)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':RRNr' => $RRNr, ':firstName' => $firstName, ':lastName' => $lastName, ':group' => $userGroup, ':timestamp' => $timestamp))) {
            //test if statement succes
            return true;
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            //throw new ApplicationException('Kon geen gebruiker in de database invoeren, gelieve dit te controleren:<br>'.$error[2]);
            //header("location: /mctesting/agga/dagga");
        }
    }

    public static function updateStatus($RRNr, $status) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE gebruikers SET actief = :status WHERE rijksregisternr = :RRNr';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':status' => $status, ':RRNr' => $RRNr))) {
            //test if statement succes
            return true;
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon de status van deze gebruiker (' . $RRNr . ') niet aanpassen, gelieve dit te controleren:<br>' . $error[2]);
        }
    }
    
    public static function update($user) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        
        //prepare sql statement
        $sql = 'UPDATE gebruikers SET voornaam = :voornaam, familienaam = :familienaam WHERE rijksregisternr = :rrnr';
        $stmt = $db->prepare($sql);
        
        if ($stmt->execute(array(':voornaam' => $user->getFirstName(), ':familienaam' => $user->getLastName(), ':rrnr' => $user->getRRnr()))) {
            //test if statement succes
            return true;
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon de gebruiker (' . $user->getRRnr() . ') niet aanpassen, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function deleteUser($RRNr) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'DELETE from GEBRUIKERS where rijksregisternr = :RRNr';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':RRNr' => $RRNr))) {
            //test if statement succes
            return true;
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon de gebruiker (' . $RRNr . ') niet verwijderen, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

}
