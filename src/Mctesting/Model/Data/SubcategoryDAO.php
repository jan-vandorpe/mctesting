<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Category;
use Mctesting\Model\Entity\Subcategory;
use Mctesting\Model\Service\CategoryService;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\QuestionService;

/* * **** Author: Bert Mortier ****** */

class SubcategoryDAO {

    public static function selectById($subcatid) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE subcatid = :subcatid limit 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatid' => $subcatid,))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return                
                //create  object
                $subcat = new Subcategory();
                $subcat->setId($record['subcatid']);
                $subcat->setSubcatname($record['subcatnaam']);
                $subcat->setActive($record['actief']);
                $subcat->setQuestions(QuestionService::getBySubCategory($subcat->getId()));
                return $subcat;
            } else {
                throw new ApplicationException('Kon geen subcategorie ophalen, gelieve dit te controleren');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De subcategorie (' . $subcatid . ') kon niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectByCategoryId($catid) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE catid = :catid ORDER BY subcatnaam';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catid' => $catid))) {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset)) {
                //create array
                $subcatarray = array();

                //create subcategory object(s)
                foreach ($resultset as $record) {
                    $subcat = new Subcategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setSubcatname($record['subcatnaam']);
                    $subcat->setActive($record['actief']);

                    //     don't set because subcategories are put into category object
                    //         $subcat->setCategory($category);
                    $subcat->setQuestions(QuestionService::getBySubCategory($subcat->getId()));
                    array_push($subcatarray, $subcat);
                }
                return $subcatarray;
            } else {
                //create array
                $subcatarray = array();
                //create object
                $subcat = new Subcategory();
                $subcatname = "nog geen subcategorie aanwezig";
                $subcat->setSubcatname($subcatname);
                //push object to array
                array_push($subcatarray, $subcat);
                return $subcatarray;
            }
        } else {
            throw new ApplicationException('De subcategorieën van de gekozen categorie (' . $categoryId . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectActiveByCategoryId($catid) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE catid = :catid AND actief = 1 ORDER BY subcatnaam';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catid' => $catid))) {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset)) {
                //create array
                $subcatarray = array();
                //create object and return
                //create subcategory object(s)
                foreach ($resultset as $record) {
                    $subcat = new Subcategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setSubcatname($record['subcatnaam']);
                    $subcat->setActive($record['actief']);

                    //     don't set because subcategories are put into category object
                    //         $subcat->setCategory($category);
                    $subcat->setQuestions(QuestionService::getBySubCategory($subcat->getId()));
                    array_push($subcatarray, $subcat);
                }
                return $subcatarray;
            } else {
                //create array
                $subcatarray = array();
                //create object
                $subcat = new Subcategory();
                $subcatname = "nog geen subcategorie aanwezig";
                $subcat->setSubcatname($subcatname);
                //push object to array and return
                array_push($subcatarray, $subcat);
                return $subcatarray;
            }
        } else {
            throw new ApplicationException('De actieve subcategorieën voor de categorie (' . $catid . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectAll() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie ORDER BY subcatnaam';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset)) {
                //create array
                $subcatarray = array();
                foreach ($resultset as $record) {
                    //create category object and return
                    //create subcategory object(s)
                    $subcat = new Subcategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setSubcategory($record['subcatnaam']);
                    $subcat->setActive($record['actief']);
                    //push object to array
                    array_push($subcatarray, $subcat);
                }
                return $subcatarray;
            } else {
                throw new ApplicationException('Er zijn geen subcategorieën gevonden');
            }
        } else {
            throw new ApplicationException('De subcategorieën konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectAllActive() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie order by catid where actief = 1 ORDER BY subcatnaam';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset)) {
                //create array
                $subcatarray = array();
                foreach ($resultset as $record) {
                    //create category object and return
                    //create subcategory object(s)
                    $subcat = new Subcategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setSubcategory($record['subcatnaam']);
                    $subcat->setActive($record['actief']);
//push object to array
                    array_push($subcatarray, $subcat);
                }
                return $subcatarray;
            } else {
                throw new ApplicationException('Er zijn geen actieve subcategorieën gevonden');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De actieve subcategorieën konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function checkName($subcatname, $catid) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE subcatnaam = :subcatname AND catid = :catid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatname' => $subcatname, ':catid' => $catid,))) {
            //test if statement retrieved something
            $result = $stmt->fetchall();
            if (!empty($result)) {
            //if statement returned a value
                throw new ApplicationException('De subcategorie (' . $subcatname . ') bestaat al, gelieve de subcategorie een andere naam te geven');
            } else {
            //if statement returns no value
                return false;
            }
        } else {
            throw new ApplicationException('De subcategorie (' . $subcatname . ') kon niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function insert($catid, $subcatname) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO subcategorie(catid, subcatnaam) values(:catid, :subcatnaam)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatnaam' => $subcatname, ':catid' => $catid,))) {
            
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon geen subcategorie in de database invoeren, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function activateById($subcatid) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE subcategorie SET actief=1 WHERE subcatid = :subcatid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatid' => $subcatid))) {
            
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon de subcategorie in de database niet op actief zetten, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function deactivateById($subcatid) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE subcategorie SET actief=0 WHERE subcatid = :subcatid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatid' => $subcatid))) {
            
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon de categorie in de database niet op passief zetten, gelieve dit te controleren:<br>' . $error[2]);
        }
    }

    public static function selectByTest($testid) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT subcategorie.subcatnaam, testsubcat.tebehalenscore FROM subcategorie inner join testsubcat on subcategorie.subcatid = testsubcat.subcatid WHERE testsubcat.testid = :testid ';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':testid', $testid);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                $result = array();
                foreach ($recordset as $record) {
                    $result[$record['subcatnaam']] = $record['tebehalenscore'];
                }
                return $result;
            } else {
                throw new ApplicationException('De gekozen test (' . $testid . ') bevat geen subcategorieen');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De subcategorieen van de gekozen test (' . $testid . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }
    
    public static function selectByCategoryIdQuestionsNotInTest($catid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE catid = :catid ORDER BY subcatnaam';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catid' => $catid)))
        {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset))
            {
                //create array
                $subcatarray = array();
                
                //create subcategory object(s)
                foreach ($resultset as $record)
                {
                    $subcat = new Subcategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setSubcatname($record['subcatnaam']);
                    $subcat->setActive($record['actief']);

                    //     don't set because subcategories are put into category object
                    //         $subcat->setCategory($category);
                    $subcat->setQuestions(QuestionService::getNotInTestBySubCategory($subcat->getId()));
                    array_push($subcatarray, $subcat);
                }
                return $subcatarray;
            } else
            {
                //create array
                $subcatarray = array();
                //create object
                $subcat = new Subcategory();
                $subcatname = "nog geen subcategorie aanwezig";
                $subcat->setSubcatname($subcatname);
                //push object to array
                array_push($subcatarray, $subcat);
                return $subcatarray;
            }
        } else
        {
            throw new ApplicationException('De subcategorieën van de gekozen categorie ('.$categoryId.') konden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    //select by id for the edit questions part
    public static function selectByIdQNIT($subcatid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE subcatid = :subcatid limit 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatid' => $subcatid,)))
        {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record))
            {
                //create object(s) and return                
                //create  object
                $subcat = new Subcategory();
                $subcat->setId($record['subcatid']);
                $subcat->setSubcatname($record['subcatnaam']);
                $subcat->setActive($record['actief']);
                $subcat->setQuestions(QuestionService::getNotInTestBySubCategory($subcat->getId()));
                return $subcat;
            } else
            {
                throw new ApplicationException('Kon geen subcategorie ophalen, gelieve dit te controleren');
            }
        } else
        {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De subcategorie ('.$subcatid.') kon niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function selectByIdForQuestions($subcatid) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE subcatid = :subcatid limit 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatid' => $subcatid,))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return                
                //create  object
                $subcat = new Subcategory();
                $subcat->setId($record['subcatid']);
                $subcat->setSubcatname($record['subcatnaam']);
                $subcat->setActive($record['actief']);
                //$subcat->setQuestions(QuestionService::getBySubCategory($subcat->getId()));
                return $subcat;
            } else {
                throw new ApplicationException('Kon geen subcategorie ophalen, gelieve dit te controleren');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De subcategorie (' . $subcatid . ') kon niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
        }
    }


}
