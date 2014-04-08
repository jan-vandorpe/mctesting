<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\User;
use Mctesting\Exception\ApplicationException;

class UserDAO
{
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
            throw new ApplicationException('gebruikers selectByEmail statement kan niet worden uitgevoerd');
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
    
    
    public static function createUser($firstName, $lastName, $RRNr)
    {
        //create db connection
        $usergroup = 1; //basisgebruiker is groep 1
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `gebruikers`(`rijksregisternr`, `voornaam`, `familienaam`,`gebruikerstype`) VALUES (:RRNr , :firstName , :LastName , :group)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':RRNr' => $RRNr, ':firstName' => $firstName, ':LastName' => $lastName, ':group' => $usergroup ))) {
            //test if statement succes
            return true;
        } else {
            throw new ApplicationException('gebruikers createUser statement kan niet worden uitgevoerd');
        }
    }
    
    
    
    
    
    
    
    
}
