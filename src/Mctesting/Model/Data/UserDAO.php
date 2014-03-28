<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\User;
use Mctesting\Exception\ApplicationException;

class UserDAO
{
    public static function selectByEmail($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikers WHERE email = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
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
                throw new ApplicationException('gebruiker niet gevonden in databank');
            }
        } else {
            throw new ApplicationException('gebruikers selectByEmail statement kan niet worden uitgevoerd');
        }
    }
    
    public static function selectByRRNr($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikers WHERE rijksregisternr = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
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
                throw new ApplicationException('gebruiker niet gevonden in databank');
            }
        } else {
            throw new ApplicationException('gebruikers selectByRRNr statement kan niet worden uitgevoerd');
        }
    }
}
