<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Test;
use Mctesting\Model\Entity\User;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\TestSubcatService;
use Mctesting\Model\Service\TestQuestionService;
use Mctesting\Model\Entity\FullTest;
use Mctesting\Model\Service\QuestionService;
use Mctesting\Model\Service\TestService;

class TestDAO {

    public static function selectAll() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM test';
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
                    $test->setTestName($record['testnaam']);
                    $test->setTestMaxDuration($record['maxduur']);
                    $test->setTestQuestionCount($record['aantalvragen']);
                    $test->setTestMaxscore($record['maxscore']);
                    $test->setTestPassPercentage($record['tebehalenscore']);
                    $test->setTestCreator($record['beheerder']);
                    //$catname = TestService::getCatName($record['testid']);
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

    public static function selectById($id) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM test WHERE testid = :testid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':testid' => $id,))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                //retrieve subcategory object
                $test = new Test();
                $test->setTestId($record['testid']);
                $test->setTestName($record['testnaam']);
                $test->setTestMaxDuration($record['maxduur']);
                $test->setTestQuestionCount($record['aantalvragen']);
                $test->setTestMaxscore($record['maxscore']);
                $test->setTestPassPercentage($record['tebehalenscore']);
                $test->setTestCreator($record['beheerder']);
                //$test->setTestCatName(TestService::getCatName($record['testid']));
                return $test;
            } else {
                throw new ApplicationException('Test selectById record is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'Test selectById statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
        }
    }

    public static function selectByBeheerder($adminId) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM test WHERE beheerder = :adminId';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':adminId' => $adminId,))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create usergroup object
                    $test = new Test();
                    $test->setTestId($record['testid']);
                    $test->setTestName($record['testnaam']);
                    $test->setTestMaxDuration($record['maxduur']);
                    $test->setTestQuestionCount($record['aantalvragen']);
                    $test->setTestMaxscore($record['maxscore']);
                    $test->setTestPassPercentage($record['tebehalenscore']);
                    $test->setTestCreator($record['beheerder']);
                    array_push($result, $test);
                }
                return $result;
            } else {
                return false;
                //throw new ApplicationException('users selectByBeheerder recordset is leeg');
            }
        } else {
            throw new ApplicationException('users selectByBeheerder statement kon niet worden uitgevoerd');
        }
    }
    
    public static function getCatName($testId) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT DISTINCT cat.catnaam FROM categorie AS cat INNER JOIN (subcategorie AS sub INNER JOIN testsubcat AS testsub ON sub.subcatid = testsub.subcatid )ON cat.catid = sub.catid WHERE testsub.testid = :testid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':testid' => $testId,))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                //retrieve subcategory object
                $testcatname = $record['catnaam'];
                //$test->setTestCreator($record['beheerder']);
                return $testcatname;
            } else {
                throw new ApplicationException('Test selectById record is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'Test selectById statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
        }
    }
    
    public static function insert($testname, $testduration, $questioncount, $maxscore, $passpercentage, $adminId, $questions, $subcatlist) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `test`(`testnaam`, `maxduur`, `aantalvragen`, `maxscore`, `tebehalenscore`, `beheerder`) VALUES (:testname,:testduration,:questioncount,:maxscore,:passpercentage,:adminId)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':testname' => $testname, ':testduration' => $testduration, ':questioncount' => $questioncount, ':maxscore' => $maxscore, ':passpercentage' => $passpercentage, ':adminId' => $adminId))) {
            //test if statement succes
            $testid = $db->lastInsertId();
            foreach ($subcatlist as $subcat) {
                TestSubcatService::create($testid, $subcat);
            }
            foreach ($questions as $questionId) {
                TestQuestionService::create($testid, $questionId);
            }


            return $testid;
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon deze test niet toevoegen: ' . $error[2]);
            //header("location: /mctesting/agga/dagga");
        }
    }

//    public static function insert($codeTeUploaden)
//    {
//        //create db connection        
//        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
//        //prepare sql statement
//        $sql = 'INSERT INTO `bramupload`(`code`) VALUES (:code)';
//        $stmt = $db->prepare($sql);
//        //test if statement can be executed
//        if ($stmt->execute(array(':code' => $codeTeUploaden ))) {            
//            //test if statement succes
//            return true;
//        } else {            
//            $error = $stmt->errorInfo();
//            //throw new ApplicationException($error[2]);
//            throw new ApplicationException('Kon deze code niet toevoegen: '.$error[2]);
//            //header("location: /mctesting/agga/dagga");
//        }
//    }
//    public static function insertSession($datum, $testid, $sessieww, $actief, $users, $afgelegd)
//    {
//        //create db connection        
//        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
//        //prepare sql statement
//        $sql = 'INSERT INTO `sessie`(`datum`, `testid`, `sessieww`, `actief`) VALUES (:datum,:testid,:sessieww,:actief)';
//        $stmt = $db->prepare($sql);
//        //test if statement can be executed
//        if ($stmt->execute(array(':datum' => $datum,':testid' => $testid,':sessieww' => $sessieww,':actief' => $actief ))) {            
//            //test if statement succes
//            $last_id = $db->lastInsertId();
//            foreach($users as $user=>$RRNr){
//               $sql = 'INSERT INTO `sessiegebruiker`(`sessieid`, `rijksregisternr`,`afgelegd`, `actief`) 
//                                    VALUES (:sessieid,:rrnr,:afgelegd,:actief)';
//               $stmt = $db->prepare($sql);
//                //test if statement can be executed
//               if ($stmt->execute(array(':sessieid' => $last_id,':rrnr' => $RRNr,':afgelegd' => $afgelegd,':actief' => $actief ))) {
//                   
//               }              
//            }
//            
//            
//            return true;
//        } else {            
//            $error = $stmt->errorInfo();
//            //throw new ApplicationException($error[2]);
//            throw new ApplicationException('Kon deze sessie niet toevoegen: '.$error[2]);
//            //header("location: /mctesting/agga/dagga");
//        }
//    }
    
    public static function selectActiveFullTestById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM test WHERE testid = :testid AND actief = :actief';
        $stmt = $db->prepare($sql);
        //bind statement parameters
        $stmt->bindParam(':testid', $id);
        $active = true;
        $stmt->bindParam(':actief', $active);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                //retrieve subcategory object
                $test = new FullTest();
                $test->setTestId($record['testid']);
                $test->setTestName($record['testnaam']);
                $test->setTestMaxDuration($record['maxduur']);
                $test->setTestQuestionCount($record['aantalvragen']);
                $test->setTestMaxscore($record['maxscore']);
                $test->setTestPassPercentage($record['tebehalenscore']);
                $test->setTestCreator($record['beheerder']);
                $questions = QuestionService::getActiveByTest($id);
                $test->setQuestions($questions);
                return $test;
            } else {
                throw new ApplicationException('Test selectActiveFullTestById record is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'Test selectActiveFullTestById statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
        }
    }
}
