<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\UserAnswerDAO;

/**
 * Description of TestSessionService
 *
 * @author cyber01
 */

class UserAnswerService
{
//    public static function getSessionsByTest($testId)
//    {
//        return TestSessionDAO::selectByTest($testId);
//    }
//    
//    public static function getById($id)
//    {
//        return TestSessionDAO::selectById($id);
//    }
    
    /** Adds a single row in the sessieGebruikerAntwoorden table
     * 
     * @param type $sessionId
     * @param type $userId
     * @param type $questionId
     * @param type $correct
     * @return type
     */
    public static function create($sessionId, $userId, $questionId, $correct)
    {
        return UserAnswerDAO::insert($sessionId, $userId, $questionId, $correct);
    }
}
