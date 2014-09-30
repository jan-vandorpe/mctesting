<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\TestSession;
use Mctesting\Model\Service\TestService;
use Mctesting\Model\Service\UserSessionService;
use Mctesting\Exception\ApplicationException;

/**
 * Description of TestSessionDAO
 *
 * @author cyber01
 */

class TestSessionDAO
{
    public static function selectAll() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM sessie ORDER BY datum';
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
                    $testSession = new TestSession();
                    $testSession->setId($record['sessieid']);
                    $testSession->setDate(new \DateTime($record['datum']));
                    $test =  TestService::getById($record['testid']);
                    $testSession->setTest($test);
                    $testSession->setPassword($record['sessieww']);
                    $testSession->setActive((boolean)$record['actief']);
                    
                    //push to result array
                    array_push($result, $testSession);
                }
                return $result;
            } else {
                throw new ApplicationException('Er zijn geen sessies gevonden');
            }
        } else {
            $error = $stmt->errorInfo(); 
            throw new ApplicationException('De sessies onden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function selectAllFiltered() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = "SELECT * FROM sessie WHERE datum > CURDATE() AND sessieid NOT IN (SELECT sessieid FROM sessiegebruiker WHERE afgelegd = 1) ORDER BY datum";
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
                    $testSession = new TestSession();
                    $testSession->setId($record['sessieid']);
                    $testSession->setDate(new \DateTime($record['datum']));
                    $test =  TestService::getById($record['testid']);
                    $testSession->setTest($test);
                    $testSession->setPassword($record['sessieww']);
                    $testSession->setActive((boolean)$record['actief']);
                    
                    //push to result array
                    array_push($result, $testSession);
                }
                return $result;
            } else {
                return false;
                //throw new ApplicationException('Er zijn geen sessies gevonden');
            }
        } else {
            $error = $stmt->errorInfo(); 
            throw new ApplicationException('De sessies onden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function selectByTest($testId)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM sessie WHERE testid = :testid ORDER BY datum';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':testid' => $testId,))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                $result = array();
                foreach ($recordset as $record) {
                    //create object(s) and return
                    $testSession = new TestSession();
                    $testSession->setId($record['sessieid']);
                    $testSession->setDate(new \DateTime($record['datum']));
                    $testSession->setTest($record['testid']);
                    $testSession->setPassword($record['sessieww']);
                    $testSession->setActive((boolean)$record['actief']);
                    
                    //push to result array
                    array_push($result, $testSession);
                }
                return $result;
            } else {
                throw new ApplicationException('Er zijn geen sessies voor de test ('.$testId.') gevonden');
            }
        } else {
//            $error = $stmt->errorInfo();
//            $errormsg = 'TestSession selectByTest statement kan niet worden uitgevoerd'
//                    . '<br>'
//                    . '<br>'
//                    . $error[2];
//            throw new ApplicationException($errormsg);
            $error = $stmt->errorInfo();
            throw new ApplicationException('De sessies voor de test ('.$testId.') konden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function selectByPW($password)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM sessie WHERE sessieww = :sessionpw ORDER BY datum';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':sessionpw' => $password,))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                $result = array();
                foreach ($recordset as $record) {
                    //create object(s) and return
                    $testSession = new TestSession();
                    $testSession->setId($record['sessieid']);
                    $testSession->setDate(new \DateTime($record['datum']));
                    $test=  TestService::getById($record['testid']);
                    $testSession->setTest($test);
                    $testSession->setPassword($record['sessieww']);
                    $testSession->setActive((boolean)$record['actief']);
                    
                    //push to result array
                    array_push($result, $testSession);
                    
                }
                
                return $result;
            } else {
                throw new ApplicationException('Er werden geen tests gevonden voor deze combinatie van rijksregisternummer en wachtwoord. Probeer opnieuw of vraag hulp'
                        . ' aan de instructeur/instructrice');
            }
        } else {//           
            $error = $stmt->errorInfo();
            throw new ApplicationException('Sesies konden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function selectById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM sessie WHERE sessieid = :sessieid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':sessieid' => $id,))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                $testSession = new TestSession();
                $testSession->setId($record['sessieid']);
                $testSession->setDate(new \DateTime($record['datum']));
                $test = TestService::getById($record['testid']);
                $testSession->setTest($test);
                $testSession->setPassword($record['sessieww']);
                $testSession->setActive((boolean)$record['actief']);
                $users = UserSessionService::getUsersBySession($testSession->getId());
                $testSession->setUsers($users);
                return $testSession;
            } else {
                throw new ApplicationException('Er werd geen sessie ('.$id.') gevonden, gelieve dit te controleren');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De sessie ('.$id.') kon niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function insert($datum, $testid, $sessieww, $users)
    {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `sessie`(`datum`, `testid`, `sessieww`) VALUES (:datum,:testid,:sessieww)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':datum' => $datum,':testid' => $testid,':sessieww' => $sessieww))) {            
            //test if statement succes
            $sessionId = $db->lastInsertId();
            foreach($users as $user=>$RRNr){
                UserSessionService::create($sessionId, $RRNr);            
            }           
            
            return true;
        } else {            
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon geen sessie in de database invoeren, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
        public static function update($sessieid, $datum, $testid, $sessieww, $users)
    {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE sessie SET datum = :datum, testid = :testid, sessieww = :sessieww WHERE sessieid = :sessieid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':datum' => $datum,':testid' => $testid,':sessieww' => $sessieww, ':sessieid' => $sessieid))) {            
            //test if statement succes
            UserSessionService::remove($sessieid);
            foreach($users as $user=>$RRNr){                
                UserSessionService::create($sessieid, $RRNr);            
            }           
            
            return true;
        } else {            
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon geen sessie in de database invoeren, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
}
