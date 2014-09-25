<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\User;
use Mctesting\Exception\ApplicationException;

class BeheerderDAO
{
    
    /*
     * alle beheerders ophalen
     */
    public static function selectAllBeheerders() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikers where gebruikerstype = 2 ORDER BY familienaam';
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
                //throw new ApplicationException('Er zijn geen beheerders gevonden');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De beheerders konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }
    
    /*
     * een gebruiekr toevoegen als beheerder
     */
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
    
    
    /*
     * gegevens van een gebruiker veranderen
     */
    public static function update($user) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        
        //prepare sql statement
        $sql = 'UPDATE gebruikers SET email = :email, voornaam = :voornaam, familienaam = :familienaam, gebruikerstype = :group WHERE rijksregisternr = :rrnr';
        $stmt = $db->prepare($sql);
        
        if ($stmt->execute(array(':email' => $user->getEmail(), ':voornaam' => $user->getFirstName(), ':familienaam' => $user->getLastName(), ':group' => $user->getGroup(), ':rrnr' => $user->getRRnr()))) {
            //test if statement succes
            return true;
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon de gebruiker (' . $user->getRRnr() . ') niet aanpassen, gelieve dit te controleren:<br>' . $error[2]);
        }
    }
    
    
    /*
     * wachtwoord veranderen van een beheerder
     * 
     * $rrnr = rijksregisternummer (id)
     * $password = hashed wachtwoord
     */
    public function changePassword($rrnr, $password){
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        
        //prepare sql statement
        $sql = 'UPDATE gebruikers SET wachtwoord = :password WHERE rijksregisternr = :rrnr';
        $stmt = $db->prepare($sql);
        
        if ($stmt->execute(array(':password' => $password, ':rrnr' => $rrnr))) {
            //test if statement succes
            return true;
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon het wachtwoord van gebruiker (' . $rrnr . ') niet aanpassen, gelieve dit te controleren:<br>' . $error[2]);
        }
    }
}

