<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\UserSession;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\TestSessionService;
use Mctesting\Model\Service\UserAnswerService;
use Mctesting\Exception\ApplicationException;

/**
 * Description of UserSessionDAO
 *
 * @author cyber01
 */
class UserSessionDAO {

    public static function selectBySession($sessionId) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM sessiegebruiker WHERE sessieid = :sessieid ORDER BY rijksregisternr';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':sessieid' => $sessionId,))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                $result = array();
                foreach ($recordset as $record) {
                    //create object(s) and return
                    $userSession = new UserSession();
                    $user = UserService::getById($record['rijksregisternr']);
                    $userSession->setUser($user);
                    $userSession->setScore($record['score']);
                    $userSession->setPercentage($record['percentage']);
                    $userSession->setPassed((boolean) $record['geslaagd']);
                    $userSession->setParticipated((boolean) $record['afgelegd']);
                    $testSession = TestSessionService::getById($record['sessieid']);
                    $userSession->setTestSession($testSession);
                    $userSession->setActive((boolean) $record['actief']);

                    //push to result array
                    array_push($result, $userSession);
                }
                return $result;
            } else {
                throw new ApplicationException('Er werd geen sessie ('.$sessionId.') gevonden, gelieve dit te controleren');
            }
        } else {
            $error = $stmt->errorInfo();            
            throw new ApplicationException('De sessie ('.$sessionId.') kon niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function selectUsersBySession($sessionId) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT rijksregisternr FROM sessiegebruiker WHERE sessieid = :sessieid ORDER BY rijksregisternr';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':sessieid' => $sessionId,))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                $result = array();
                foreach ($recordset as $record) {     
                    //push to result array
                    array_push($result, $record['rijksregisternr']);
                }
                return $result;
            } else {
                throw new ApplicationException('Er werd geen gebruikers voor de sessie ('.$sessionId.') gevonden, gelieve dit te controleren');
            }
        } else {
            $error = $stmt->errorInfo();            
            throw new ApplicationException('De gebruikers van sessie ('.$sessionId.') konden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function selectByUserAndSession($sessionId, $userId) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM sessiegebruiker WHERE sessieid = :sessieid AND rijksregisternr = :userid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':sessieid' => $sessionId,':userid' => $userId))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                $result = array();
                foreach ($recordset as $record) {
                    //create object(s) and return
                    $userSession = new UserSession();
                    $user = UserService::getById($record['rijksregisternr']);
                    $userSession->setUser($user);
                    $userSession->setScore($record['score']);
                    $userSession->setPercentage($record['percentage']);
                    $userSession->setPassed((boolean) $record['geslaagd']);
                    $userSession->setParticipated((boolean) $record['afgelegd']);
                    $testSession = TestSessionService::getById($sessionId);
                    $userSession->setTestSession($testSession);
                    $userSession->setActive((boolean) $record['actief']);

                    //push to result array
                    array_push($result, $userSession);
                }
                return $result;
            } else {
                return false;
                //throw new ApplicationException('Er zijn geen testsessies gevonden voor deze combinatie van rijksregisternummer en wachtwoord');
            }
        } else {
            $error = $stmt->errorInfo();            
            throw new ApplicationException('De sessie kon niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }

    public static function selectByUser($userId) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM sessiegebruiker WHERE rijksregisternr = :userid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':userid' => $userId))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                $result = array();
                foreach ($recordset as $record) {
                    //create object(s) and return
                    $userSession = new UserSession();
                    $user = UserService::getById($record['rijksregisternr']);
                    $userSession->setUser($user);
                    $userSession->setScore($record['score']);
                    $userSession->setPercentage($record['percentage']);
                    $userSession->setPassed((boolean) $record['geslaagd']);
                    $userSession->setParticipated((boolean) $record['afgelegd']);
                    $testSession = TestSessionService::getById($record['sessieid']);
                    $userSession->setTestSession($testSession);
                    $userSession->setActive((boolean) $record['actief']);

                    //push to result array
                    array_push($result, $userSession);
                }
                return $result;
            } else {
                return false;
                //throw new ApplicationException('Er werden geen sessies gevonden voor de gekozen gebruiker ('.$userId.')');
            }
        } else {
            $error = $stmt->errorInfo();            
            throw new ApplicationException('De testen van de gekozen gebruiker ('.$userId.') konden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function insert($sessionId, $RRNr) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement

        $sql = 'INSERT INTO `sessiegebruiker`(`sessieid`, `rijksregisternr`) 
                                    VALUES (:sessionid,:rrnr)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':sessionid' => $sessionId, ':rrnr' => $RRNr))) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon geen sessiegebruiker in de database invoeren, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function delete($sessionId) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement

        $sql = 'DELETE FROM `sessiegebruiker` WHERE `sessieid` = :sessionid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':sessionid' => $sessionId ))) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon sessiegebruikers in de database niet deleten, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function update($userSession, $subcatRes) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        
        //prepare sql statement
        $sql = 'UPDATE sessiegebruiker SET score = :score, percentage = :percentage, afgelegd = :participated, geslaagd = :passed 
                    WHERE rijksregisternr = :rrnr AND sessieid = :sessieid';
        $stmt = $db->prepare($sql);
        //bind parameters
        $stmt->bindParam(':score', $userSession->getScore());
        $stmt->bindParam(':percentage', $userSession->getPercentage());
        $stmt->bindParam(':participated', $userSession->getParticipated());
        $stmt->bindParam(':passed', $userSession->getPassed());
        $stmt->bindParam(':rrnr', $userSession->getUser()->getRRnr());
        $stmt->bindParam(':sessieid', $userSession->getTestSession()->getId());
        
        //test if statement can be executed
        if ($stmt->execute()) {
            //add user answers to DB
            foreach ($userSession->getAnswers() as $questionId => $correct) {
                UserAnswerService::create(
                        $userSession->getTestSession()->getId(),
                        $userSession->getUser()->getRRnr(),
                        $questionId,
                        $correct);
            }
            
            foreach ($subcatRes as $subcatId => $subcatResults){
            $score = $subcatResults['score'];
            $percentage = $subcatResults['percentage'];
            self::createSubCatTestResults($userSession, $subcatId, $score, $percentage);
            }
            
            return true;
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon deze sessiegebruiker niet aanpassen, gelieve dit te controleren:<br>'.$error[2]);
            //header("location: /mctesting/agga/dagga");
        }
    }
    
    public static function delibereer($sessionId, $userId) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE sessiegebruiker SET geslaagd = 1 WHERE sessieid = :sessieid and rijksregisternr = :userid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':sessieid' => $sessionId, ':userid' => $userId))) {
            //test if statement succes
            return true;
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('kan de gebruiker niet delibereren, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function createSubCatTestResults($userSession, $subcatId, $score, $percentage){
      //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `sessiegebruikercategoriepercentages`(`sessieid`, `rijksregisternr`, `testid`, `subcatid`, `score`, `percentage`) '
                . 'VALUES ('
                . ':sessionid,:userid,:testid,:subcatid,:score,:percentage)';
        $stmt = $db->prepare($sql);
        //bind parameters
        $stmt->bindParam(':sessionid', $userSession->getTestSession()->getId());
        $stmt->bindParam(':userid', $userSession->getUser()->getRRnr());
        $stmt->bindParam(':testid', $userSession->getTestSession()->getTest()->getTestId());
        $stmt->bindParam(':subcatid', $subcatId);
        $stmt->bindParam(':score', $score);
        $stmt->bindParam(':percentage', $percentage);
        //test if statement can be executed
        if ($stmt->execute()) {
          return true;
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon geen subcat resultaten in de database invoeren, gelieve dit te controleren:<br>'.$error[2]);
            //header("location: /mctesting/agga/dagga");
        }
    }

}
