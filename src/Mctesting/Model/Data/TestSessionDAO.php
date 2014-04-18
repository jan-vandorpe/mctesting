<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\TestSession;
use Mctesting\Model\Service\TestService;

/**
 * Description of TestSessionDAO
 *
 * @author cyber01
 */

class TestSessionDAO
{
    public static function selectByTest($testId)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM sessie WHERE testid = :testid';
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
                throw new ApplicationException('TestSession selectByTest recordset is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'TestSession selectByTest statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
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
                return $testSession;
            } else {
                throw new ApplicationException('Sessie selectById record is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'Sessie selectById statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
        }
    }
}
