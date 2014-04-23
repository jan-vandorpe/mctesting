<?php

namespace Mctesting\Model\Data;

use Mctesting\Exception\ApplicationException;

/**
 * Description of UserAnswerDAO
 *
 * @author Bram
 */
class UserAnswerDAO {

    public static function insert($user, $answers) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `sessiegebruikerantwoorden`(`sessieid`, `gebruikerid`,`vraagid`, `correct`) 
                                    VALUES (:sessionid,:userid,:questionid,:correct)';
               $stmt = $db->prepare($sql);
                //test if statement can be executed
               if ($stmt->execute(array(':sessionid' => $testid,':userid' => $questionId,':questionid' => $testid,':correct' => $questionId ))) {                   
               }else{
                   $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon dit antwoord niet toevoegen: '.$error[2]);              
            }
    }

}
