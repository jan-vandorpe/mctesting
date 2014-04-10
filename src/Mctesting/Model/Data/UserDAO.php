<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\User;
use Mctesting\Exception\ApplicationException;

class UserDAO
{
    
    public static function selectAll()
    {
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
    
    
    public static function selectAllBaseUsers()
    {
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
    
    
    
    
    public static function selectByEmail($login, $password)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikers WHERE email = :login and wachtwoord = :password' ;
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':login' => $login, ':password' => $password))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                $group = \Mctesting\Model\Service\UsergroupService::getById($record['gebruikerstype']);
                //create  object
                
                $user = new User();
                $user->setRRnr($record['rijksregisternr']);
                $user->setFirstName($record['voornaam']);
                $user->setLastName($record['familienaam']);
                $user->setEmail($record['email']);
                $user->setGroup($group);
                return $user;
            } else {
                throw new ApplicationException('Kon niet inloggen met deze gegevens, gelieve deze te controleren');
            }
        } else {
            throw new ApplicationException('gebruikers selectByEmail statement kan niet worden uitgevoerd.');
        }
    }
    
    public static function selectByRRNr($login)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikers WHERE rijksregisternr = :login';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':login' => $login))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                $group = \Mctesting\Model\Service\UsergroupService::getById($record['gebruikerstype']);
                //create  object
                
                $user = new User();
                $user->setRRnr($record['rijksregisternr']);
                $user->setFirstName($record['voornaam']);
                $user->setLastName($record['familienaam']);
                $user->setEmail($record['email']);
                $user->setGroup($group);
                return $user;
            } else {
                throw new ApplicationException('Kon niet inloggen met deze gegevens, gelieve deze te controleren');
            }
        } else {
            throw new ApplicationException('gebruikers selectByRRNr statement kan niet worden uitgevoerd');
        }
    }
    
    
    public static function insert($firstName, $lastName, $RRNr, $userGroup)
    {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `gebruikers`(`rijksregisternr`, `voornaam`, `familienaam`,`gebruikerstype`) VALUES (:RRNr , :firstName , :lastName , :group)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':RRNr' => $RRNr, ':firstName' => $firstName, ':lastName' => $lastName, ':group' => $userGroup ))) {            
            //test if statement succes
            return true;
        } else {            
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon deze gebruiker niet toevoegen: '.$error[2]);
            //header("location: /mctesting/agga/dagga");
        }
    }
    
    
    
    
    
    
    
    
}
