<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\User;
use Mctesting\Exception\ApplicationException;

class BeheerderDAO
{
    public static function insert($user, $password, $timestamp) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `gebruikers`(`rijksregisternr`, `email`, `voornaam`, `familienaam`, `wachtwoord`, `gebruikerstype`, `toegevoegd`) VALUES (:RRNr , :email, :firstName , :lastName , :wachtwoord, :group, :timestamp)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':RRNr' => $user->getRRnr(), ':email' => $user->getEmail(), ':firstName' => $user->getFirstName(), ':lastName' => $user->getLastName(), ':wachtwoord' => $password, ':group' => $user->getGroup(), ':timestamp' => $timestamp))) {
            //test if statement succes
            return true;
        } else {
            $error = $stmt->errorInfo();
            if ($error[1] == 1062){
                throw new ApplicationException('De beheerder ('.$user->getRRnr().') bestaat al');
            }else{
                throw new ApplicationException('Kon geen beheerder in de database invoeren, gelieve dit te controleren:<br>'.$error[2]);
            }
        }
    }
}

