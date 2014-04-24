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
        $sql = 'SELECT * FROM sessiegebruiker WHERE sessieid = :sessieid';
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
                throw new ApplicationException('UserSession selectBySession recordset is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'UserSession selectBySession statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
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
                    $testSession = TestSessionService::getById($record['sessieid']);
                    $userSession->setTestSession($testSession);
                    $userSession->setActive((boolean) $record['actief']);

                    //push to result array
                    array_push($result, $userSession);
                }
                return $result;
            } else {
                throw new ApplicationException('UserSession selectByUserANDSession recordset is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'UserSession selectBySession statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
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
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon deze sessiegebruiker niet toevoegen: ' . $error[2]);
            //header("location: /mctesting/agga/dagga");
        }
    }
    
    public static function update($userSession) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        
        //prepare sql statement
        $sql = 'UPDATE sessiegebruiker SET score = :score, percentage = :percentage, afgelegd = :participated 
                    WHERE rijksregisternr = :rrnr AND sessieid = :sessieid';
        $stmt = $db->prepare($sql);
        //bind parameters
        $stmt->bindParam(':score', $userSession->getScore());
        $stmt->bindParam(':percentage', $userSession->getPercentage());
        $stmt->bindParam(':participated', $userSession->getParticipated());
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
            
            return true;
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon deze sessiegebruiker niet updaten: ' . $error[2]);
            //header("location: /mctesting/agga/dagga");
        }
    }

}
