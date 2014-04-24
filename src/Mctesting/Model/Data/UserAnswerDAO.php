<?php

namespace Mctesting\Model\Data;

use Mctesting\Exception\ApplicationException;

/**
 * Description of UserAnswerDAO
 *
 * @author Bram
 */
class UserAnswerDAO {

    public static function insert($sessionId, $userId, $questionId, $correct) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        
        //prepare sql statement
        $sql = 'INSERT INTO sessiegebruikerantwoorden (sessieid, gebruikerid, vraagid, correct) 
                    VALUES (:sessionid, :userid, :questionid, :correct)';
        $stmt = $db->prepare($sql);
        //bind parameters
        $stmt->bindParam(':sessionid', $sessionId);
        $stmt->bindParam(':userid', $userId);
        $stmt->bindParam(':questionid', $questionId);
        $stmt->bindParam(':correct', $correct);
        //test if statement can be executed
        if ($stmt->execute()) { 
            //row inserted
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon dit antwoord niet toevoegen: '.$error[2]);              
        }
    }
}
