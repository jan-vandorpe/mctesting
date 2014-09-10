<?php

namespace Mctesting\Model\Data;

use Mctesting\Exception\ApplicationException;

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
}
