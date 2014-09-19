<?php

namespace Mctesting\Model\Data;

use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Entity\Subcategory;
use Mctesting\Model\Entity\AnsweredQuestion;
use Mctesting\Model\Service\SubcategoryService;
use Mctesting\Model\Entity\UserSessionSubCategory;
use Mctesting\Model\Service\MediaService;

/**
 * Description of TestQuestionDAO
 *
 * @author Bram
 */
class TestQuestionDAO {

    public static function insert($testid, $questionId) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `testvragen`(`testid`, `vraagid`) 
                                    VALUES (:testid,:vraagid)';
               $stmt = $db->prepare($sql);
                //test if statement can be executed
               if ($stmt->execute(array(':testid' => $testid,':vraagid' => $questionId ))) {                   
               }else{
                   $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon deze testvraag niet toevoegen: '.$error[2]);              
            }
    }
    
    
    
    public static function selectCategoriesAnsweredQuestions($sessieid, $userid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
//        $sql = 'SELECT distinct subcategorie.subcatid, subcategorie.subcatnaam, subcategorie.actief from subcategorie 
//            inner join (vraag inner join sessiegebruikerantwoorden on vraag.vraagid = sessiegebruikerantwoorden.vraagid)
//            on subcategorie.subcatid = vraag.subcatid
//            WHERE sessiegebruikerantwoorden.sessieid = :sessieid AND sessiegebruikerantwoorden.gebruikerid = :userid
//            ';
        $sql = 'SELECT sessiegebruikercategoriepercentages.subcatid, score, percentage, subcatnaam, tebehalenscore
                from sessiegebruikercategoriepercentages inner join ( subcategorie inner join testsubcat on subcategorie.subcatid = testsubcat.subcatid)
                on sessiegebruikercategoriepercentages.testid = testsubcat.testid
                and sessieid = :sessieid 
                and rijksregisternr = :userid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':sessieid' => $sessieid,':userid' => $userid)))
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
                    $subcat = new UserSessionSubCategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setSubcatname($record['subcatnaam']);
                    //$subcat->setActive($record['actief']);                  
                    $subcat->setQuestions(TestQuestionDAO::selectQuestionsByCategory($subcat->getId(), $sessieid, $userid));
                    $subcat->setPercentage($record['percentage']);
                    $subcat->setScore($record['score']);
                    $subcat->setPassPercentage($record['tebehalenscore']);
                    array_push($subcatarray, $subcat);
                }
                return $subcatarray;
            } else
            {
                return false;
            }
        } else
        {
            throw new ApplicationException('Ophalen subcategorieset statement kan niet worden uitgevoerd');
        }
    }
    
    public static function selectQuestionsByCategory($subcatId, $sessieid, $userid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT vraag.vraagid, vraag.vraagtekst, vraag.gewicht, sessiegebruikerantwoorden.correct
            FROM vraag inner join sessiegebruikerantwoorden on vraag.vraagid = sessiegebruikerantwoorden.vraagid
            WHERE vraag.subcatid = :catid
            AND sessiegebruikerantwoorden.sessieid = :sessieid AND sessiegebruikerantwoorden.gebruikerid = :userid
            ';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catid' => $subcatId,':sessieid' => $sessieid,':userid' => $userid))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                $result = array();
                foreach ($recordset as $record) {
                    //create object(s) and return
                    //retrieve media filename array for question
                    $media = MediaService::getByQuestion($record['vraagid']);
                    //create question object
                    $question = new AnsweredQuestion();
                    $question->setId($record['vraagid']);
                    $question->setText($record['vraagtekst']);
                    $question->setWeight($record['gewicht']);
                    $question->setMedia($media);
                    $question->setCorrect($record['correct']);
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
}
