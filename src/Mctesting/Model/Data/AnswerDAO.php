<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Answer;
use Mctesting\Exception\ApplicationException;

/**
 * Description of AnswerDAO
 *
 * @author cyber01
 */
class AnswerDAO
{
    public static function selectByQuestion($questionId)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM antwoorden WHERE vraagid = :vraagid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':vraagid' => $questionId,))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create answer object
                    $answer = new Answer();
                    $answer->setId($record['antwoordid']);
                    $answer->setQuestionId($record['vraagid']);
                    $answer->setText($record['antwoordtekst']);
                    array_push($result, $answer);
                }
                return $result;
            } else {
                throw new ApplicationException('Antwoorden selectByQuestion recordset is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'Antwoorden selectByQuestion statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
        }
    }
    
    public static function selectByQuestionAndId($questionId, $answerId)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM antwoorden WHERE vraagid = :vraagid AND antwoordid = :antwoordid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':vraagid' => $questionId,':antwoordid' => $answerId,))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object and return
                //create answer object
                $answer = new Answer();
                $answer->setId($record['antwoordid']);
                $answer->setQuestionId($record['vraagid']);
                $answer->setText($record['antwoordtekst']);
                return $answer;
            } else {
                throw new ApplicationException('Antwoorden selectByQuestionAndId record is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'Antwoorden selectByQuestionAndId statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
        }
    }
    
    public static function insert($answer)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO antwoorden';
        $sql .= ' (vraagid, antwoordid, antwoordtekst, media)';
        $sql .= ' VALUES (:vraagid, :antwoordid, :antwoordtekst, :media)';
        $stmt = $db->prepare($sql);
        
        //test if statement can be executed
        if ($stmt->execute(array(':vraagid' => $answer->getQuestionId(),
                                ':antwoordid' => $answer->getId(),
                                ':antwoordtekst' => $answer->getText(),
                                ':media' => $answer->getMedia(),
                                ))) {
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
