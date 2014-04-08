<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Answer;

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
            throw new ApplicationException('Antwoorden selectByQuestion statement kan niet worden uitgevoerd');
        }
    }
}
