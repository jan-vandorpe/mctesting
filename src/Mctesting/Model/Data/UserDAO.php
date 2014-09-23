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
        $sql = 'SELECT * FROM gebruikers';
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
                    $user->setGroup($record['wachtwoord']);
                    $user->setGroup($record['gebruikerstype']);

                    array_push($result, $user);
                }
                return $result;
            } else {
                throw new ApplicationException('users selectAll recordset is leeg');
            }
        } else {
            throw new ApplicationException('users selectAll statement kon niet worden uitgevoerd');
        }
    }

    public static function selectAllBaseUsers() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikers where gebruikerstype = 1';
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
                throw new ApplicationException('users selectAllgebruikers recordset is leeg');
            }
        } else {
            throw new ApplicationException('users selectAllgebruikers statement kon niet worden uitgevoerd');
        }
    }

    public static function selectByEmail($email, $password) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikers WHERE email = :email';
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
                throw new ApplicationException('Geen user gevonden met de opgegeven waarden.');
            }
        } else {
            throw new ApplicationException('User selectByEmail statement kan niet worden uitgevoerd.');
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
            throw new ApplicationException('User selectByRRNr statement kan niet worden uitgevoerd.');
        }
    }

    public static function insert($firstName, $lastName, $RRNr, $userGroup) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `gebruikers`(`rijksregisternr`, `voornaam`, `familienaam`,`gebruikerstype`) VALUES (:RRNr , :firstName , :lastName , :group)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':RRNr' => $RRNr, ':firstName' => $firstName, ':lastName' => $lastName, ':group' => $userGroup))) {
            //test if statement succes
            return true;
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon deze gebruiker niet toevoegen: ' . $error[2]);
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
            throw new ApplicationException('Kon de status van deze gebruiker niet aanpassen: ' . $error[2]);
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
            throw new ApplicationException('Kon deze gebruiker niet verwijderen: ' . $error[2]);
        }
    }

}
