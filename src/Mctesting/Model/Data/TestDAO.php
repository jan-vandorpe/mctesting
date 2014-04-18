<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Test;
use Mctesting\Model\Entity\User;
use Mctesting\Exception\ApplicationException;

class TestDAO
{
    
    public static function selectAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM bramtest';
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
                    $test = new Test();
                    $test->setTestId($record['testid']);
                    $test->setTestNaam($record['testnaam']);
                    $test->setTestMaxDuur($record['maxduur']);
                    $test->setTestAantalvragen($record['aantalvragen']);
                    $test->setTestMaxscore($record['maxscore']);
                    $test->setTestBeheerder($record['beheerder']);
                    array_push($result, $test);
                }
                return $result;
            } else {
                throw new ApplicationException('users selectAll recordset is leeg');
            }
        } else {
            throw new ApplicationException('users selectAll statement kon niet worden uitgevoerd');
        }
    }
       
    
    
    public static function insert($codeTeUploaden)
    {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `bramupload`(`code`) VALUES (:code)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':code' => $codeTeUploaden ))) {            
            //test if statement succes
            return true;
        } else {            
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon deze code niet toevoegen: '.$error[2]);
            //header("location: /mctesting/agga/dagga");
        }
    }
    
    
    public static function insertSession($datum, $testid, $sessieww, $actief, $users, $afgelegd)
    {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `bramsessie`(`datum`, `testid`, `sessieww`, `actief`) VALUES (:datum,:testid,:sessieww,:actief)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':datum' => $datum,':testid' => $testid,':sessieww' => $sessieww,':actief' => $actief ))) {            
            //test if statement succes
            $last_id = $db->lastInsertId();
            foreach($users as $user=>$RRNr){
               $sql = 'INSERT INTO `bramsessiegebruiker`(`sessieid`, `rijksregisternr`,`afgelegd`, `actief`) 
                                    VALUES (:sessieid,:rrnr,:afgelegd,:actief)';
               $stmt = $db->prepare($sql);
                //test if statement can be executed
               if ($stmt->execute(array(':sessieid' => $last_id,':rrnr' => $RRNr,':afgelegd' => $afgelegd,':actief' => $actief ))) {
                   
               }              
            }
            
            
            return true;
        } else {            
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon deze sessie niet toevoegen: '.$error[2]);
            //header("location: /mctesting/agga/dagga");
        }
    }
    
    
    public static function insertTest($testname, $testduration, $questioncount, $maxscore, $adminId, $questions)
    {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `bramtest`(`testnaam`, `maxduur`, `aantalvragen`, `maxscore`, `beheerder`) VALUES (:testname,:testduration,:questioncount,:maxscore,:adminId)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':testname' => $testname,':testduration' => $testduration,':questioncount' => $questioncount,':maxscore' => $maxscore ,':adminId' => $adminId))) {            
            //test if statement succes
            $last_id = $db->lastInsertId();
            foreach($questions as $questionId){                
               $sql = 'INSERT INTO `bramtestvragen`(`testid`, `vraagid`) 
                                    VALUES (:testid,:vraagid)';
               $stmt = $db->prepare($sql);
                //test if statement can be executed
               if ($stmt->execute(array(':testid' => $last_id,':vraagid' => $questionId ))) {                   
               }else{
                   $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon deze test niet toevoegen: '.$error[2]);              
            }
            
               }
            
            
            return true;
        } else {            
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon deze test niet toevoegen: '.$error[2]);
            //header("location: /mctesting/agga/dagga");
        }
    }
    
    
    
    
    
}
