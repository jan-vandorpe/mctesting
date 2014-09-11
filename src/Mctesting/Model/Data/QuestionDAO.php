<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Question;
use Mctesting\Model\Service\AnswerService;
use Mctesting\Model\Service\SubcategoryService;
use Mctesting\Model\Service\MediaService;
use Mctesting\Exception\ApplicationException;

/**
 * Description of QuestionDAO
 * 
 * Data Access Object for Question Entity/Table
 *
 * @author cyber01
 */
class QuestionDAO
{
    /*
     * Returns a single question object with given id.
     */

    public static function selectById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM vraag WHERE vraagid = :vraagid';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':vraagid', $id);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                //retrieve subcategory object
                $subcategory = SubcategoryService::getById($record['subcatid']);
                //retrieve answers for question
                $answers = AnswerService::getByQuestion($record['vraagid']);
                //retrieve media filename array for question
                $media = MediaService::getByQuestion($record['vraagid']);
                //create question object
                $question = new Question();
                $question->setId($record['vraagid']);
                $question->setText($record['vraagtekst']);
                $question->setWeight($record['gewicht']);
                $question->setSubcategory($subcategory);
                $question->setCorrectAnswer($record['correctantwoord']);
                $question->setAnswers($answers);
                $question->setMedia($media);
                $question->setActive((boolean) $record['actief']);
                return $question;
            } else {
                throw new ApplicationException('Vraag selectById record is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'Vraag selectById statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
        }
    }

    /*
     * Returns an array of question objects based on given categoryid.
     */

    public static function selectByCategory($categoryId)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM vraag WHERE subcatid IN (SELECT subcatid FROM subcategorie WHERE catid = :catid)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':catid', $categoryId);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                $result = array();
                foreach ($recordset as $record) {
                    //create object(s) and return
                    //retrieve subcategory object
                    $subcategory = SubcategoryService::getById($record['subcatid']);
                    //retrieve answers for question
                    $answers = AnswerService::getByQuestion($record['vraagid']);
                    //retrieve media filename array for question
                    $media = MediaService::getByQuestion($record['vraagid']);
                    //create question object
                    $question = new Question();
                    $question->setId($record['vraagid']);
                    $question->setText($record['vraagtekst']);
                    $question->setWeight($record['gewicht']);
                    $question->setSubcategory($subcategory);
                    $question->setCorrectAnswer($record['correctantwoord']);
                    $question->setAnswers($answers);
                    $question->setMedia($media);
                    $question->setActive((boolean) $record['actief']);
                    array_push($result, $question);
                }
                return $result;
            } else {
                throw new ApplicationException('Vraag selectByCategory record is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'Vraag selectByCategory statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
        }
    }

    /*
     * Returns an array of ACTIVE question objects based on given categoryid.
     */

    public static function selectActiveByCategory($categoryId)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM vraag WHERE actief = :actief AND subcatid IN (SELECT subcatid FROM subcategorie WHERE catid = :catid)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':catid', $categoryId);
        $active = true;
        $stmt->bindParam(':actief', $active);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                $result = array();
                foreach ($recordset as $record) {
                    //create object(s) and return
                    //retrieve subcategory object
                    $subcategory = SubcategoryService::getById($record['subcatid']);
                    //retrieve answers for question
                    $answers = AnswerService::getByQuestion($record['vraagid']);
                    //retrieve media filename array for question
                    $media = MediaService::getByQuestion($record['vraagid']);
                    //create question object
                    $question = new Question();
                    $question->setId($record['vraagid']);
                    $question->setText($record['vraagtekst']);
                    $question->setWeight($record['gewicht']);
                    $question->setSubcategory($subcategory);
                    $question->setCorrectAnswer($record['correctantwoord']);
                    $question->setAnswers($answers);
                    $question->setMedia($media);
                    $question->setActive((boolean) $record['actief']);
                    array_push($result, $question);
                }
                return $result;
            } else {
                throw new ApplicationException('Vraag selectActiveByCategory record is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'Vraag selectActiveByCategory statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
        }
    }

    /*
     * Returns an array of ACTIVE question objects based on given testid.
     */

    public static function selectActiveByTest($testId)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM vraag WHERE actief = :actief AND vraagid IN (SELECT vraagid FROM testvragen WHERE testid = :testid)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':testid', $testId);
        $active = true;
        $stmt->bindParam(':actief', $active);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                $result = array();
                foreach ($recordset as $record) {
                    //create object(s) and return
                    //retrieve subcategory object
                    $subcategory = SubcategoryService::getById($record['subcatid']);
                    //retrieve answers for question
                    $answers = AnswerService::getByQuestion($record['vraagid']);
                    //retrieve media filename array for question
                    $media = MediaService::getByQuestion($record['vraagid']);
                    //create question object
                    $question = new Question();
                    $question->setId($record['vraagid']);
                    $question->setText($record['vraagtekst']);
                    $question->setWeight($record['gewicht']);
                    $question->setSubcategory($subcategory);
                    $question->setCorrectAnswer($record['correctantwoord']);
                    $question->setAnswers($answers);
                    $question->setMedia($media);
                    $question->setActive((boolean) $record['actief']);
                    array_push($result, $question);
                }
                return $result;
            } else {
                throw new ApplicationException('Vraag selectActiveByTest record is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'Vraag selectActiveByTest statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
        }
    }

    /*
     * Inserts a new question in the database.
     */

    public static function insert($questionText, $subcatId, $weight, $correctAnswerId, $answersArray, $questionMediaFileNames)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO vraag';
        $sql .= ' (subcatid, vraagtekst, gewicht, correctantwoord)';
        $sql .= ' VALUES (:subcatid, :vraagtekst, :gewicht, :correctantwoord)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':subcatid', $subcatId);
        $stmt->bindParam(':vraagtekst', $questionText);
        $stmt->bindParam(':gewicht', $weight);
        $stmt->bindParam(':correctantwoord', $correctAnswerId);
        //test if statement can be executed
        if ($stmt->execute()) {
            $questionId = $db->lastInsertId();
            AnswerService::create($questionId, $answersArray);
            MediaService::create($questionId, $questionMediaFileNames);
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'Antwoord insert statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
        }
    }

}
