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
        $sql = 'SELECT * FROM test ORDER BY testnaam';
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
                    $test->setStatus($record['actief']);
                    $test->setPublished($record['gepubliceerd']);
                    array_push($result, $test);
                }
                return $result;
            } else {
                return false;
                //throw new ApplicationException('Er zijn geen testen gevonden');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De testen konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectAllPublished() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM test WHERE gepubliceerd = 1 ORDER BY testnaam';
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
                    $test->setStatus($record['actief']);
                    $test->setPublished($record['gepubliceerd']);
                    array_push($result, $test);
                }
                return $result;
            } else {
                return false;
                //throw new ApplicationException('Er zijn geen testen gevonden');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De testen konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectAllWithoutSessions() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM test WHERE testid NOT IN (SELECT testid FROM sessie) ORDER BY testnaam';
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
                    $test->setStatus($record['actief']);
                    array_push($result, $test);
                }
                return $result;
            } else {
                return false;
                //throw new ApplicationException('Er zijn geen testen gevonden');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De testen konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectUnpublishedTests() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM test WHERE gepubliceerd = 0 ORDER BY testnaam';
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
                    $test->setStatus($record['actief']);
                    array_push($result, $test);
                }
                return $result;
            } else {
                return false;
                //throw new ApplicationException('Er zijn geen testen gevonden');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De testen konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectAllWithSessions() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM test WHERE testid IN (SELECT testid FROM sessie) ORDER BY testnaam';
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
                    $test->setStatus($record['actief']);
                    array_push($result, $test);
                }
                return $result;
            } else {
                return false;
                //throw new ApplicationException('Er zijn geen testen gevonden');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De testen konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
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
                $test->setStatus($record['actief']);
                return $test;
            } else {
                throw new ApplicationException('Er werd geen test (' . $id . ') gevonden, gelieve dit te controleren');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De test (' . $id . ') kon niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectByBeheerder($adminId) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM test WHERE beheerder = :adminId ORDER BY testnaam';
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
                    $test->setStatus($record['actief']);
                    $test->setPublished($record['gepubliceerd']);
                    array_push($result, $test);
                }
                return $result;
            } else {
                return false;
                //throw new ApplicationException('users selectByBeheerder recordset is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De testen van de gekozen beheerder (' . $adminId . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
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
                throw new ApplicationException('Er werd geen categorienaam gevonden, gelieve dit te controleren');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De categorienaam van de test (' . $testId . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function insert($testname, $testduration, $questioncount, $maxscore, $passpercentage, $adminId, $questions, $subcatlist) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `test`(`testnaam`, `maxduur`, `aantalvragen`, `maxscore`, `tebehalenscore`, `beheerder`) VALUES (:testname,:testduration,:questioncount,:maxscore,:passpercentage,:adminId)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':testname' => ucfirst($testname), ':testduration' => $testduration, ':questioncount' => $questioncount, ':maxscore' => $maxscore, ':passpercentage' => $passpercentage, ':adminId' => $adminId))) {
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
            throw new ApplicationException('Kon geen test in de database invoeren, gelieve dit te controleren:<br>' . $error[2]);
            //header("location: /mctesting/agga/dagga");
        }
    }

    public static function selectActiveFullTestById($id) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM test WHERE testid = :testid AND actief = :actief ORDER BY testnaam';
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
                $test->setStatus($record['actief']);
                return $test;
            } else {
                //throw new ApplicationException('Er is geen actieve test ('.$id.') gevonden');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De actieve test (' . $id . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function update($testid, $testname, $testduration, $questioncount, $maxscore, $passpercentage, $adminId, $questions, $subcatlist) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE `test` SET `testnaam` = :testname, `maxduur` = :testduration, `aantalvragen` = :questioncount, `maxscore` = :maxscore, `tebehalenscore` = :passpercentage, `beheerder` = :adminId  WHERE testid = :testid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':testname' => ucfirst($testname), ':testduration' => $testduration, ':questioncount' => $questioncount, ':maxscore' => $maxscore, ':passpercentage' => $passpercentage, ':adminId' => $adminId, ':testid' => $testid))) {
            TestSubcatService::remove($testid);
            foreach ($subcatlist as $subcat) {
                TestSubcatService::create($testid, $subcat);
            }
            TestQuestionService::remove($testid);
            foreach ($questions as $questionId) {
                TestQuestionService::create($testid, $questionId);
            }
            return $testid;
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon de test niet aanpassen, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function updateStatus($testid, $status) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE test SET actief = :status WHERE testid = :testid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':status' => $status, ':testid' => $testid))) {
            //test if statement succes
            return true;
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon de status van deze test (' . $testid . ') niet aanpassen, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function publish($testid) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE test SET gepubliceerd = 1 WHERE testid = :testid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':testid' => $testid))) {
            //test if statement succes
            return true;
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon de test (' . $testid . ') niet aanpassen, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

}
