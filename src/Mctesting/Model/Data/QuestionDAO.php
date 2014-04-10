<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Question;
use Mctesting\Model\Service\AnswerService;
use Mctesting\Model\Service\SubcategoryService;
use Mctesting\Model\Service\MediaService;

/**
 * Description of QuestionDAO
 *
 * @author cyber01
 */
class QuestionDAO 
{
    public static function selectById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM vraag WHERE vraagid = :vraagid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':vraagid' => $id,))) {
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
    
    public static function insert($text, $subcatId, $weight, $correctAnswerId, $answers, $media)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO vraag';
        $sql .= ' (subcatid, vraagtekst, gewicht, correctantwoord)';
        $sql .= ' VALUES (:subcatid, :vraagtekst, :gewicht, :correctantwoord)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':subcatid', $subcatId);
        $stmt->bindParam(':vraagtekst', $text);
        $stmt->bindParam(':gewicht', $weight);
        $stmt->bindParam(':correctantwoord', $correctAnswerId);
        //test if statement can be executed
        if ($stmt->execute()) {
            $questionId = $db->lastInsertId();
            AnswerService::create($questionId, $answers);
            MediaService::create($questionId, $media);
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
