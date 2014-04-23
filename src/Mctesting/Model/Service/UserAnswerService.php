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
    
    
    public static function create($user, $answers)
    {
        
        return UserAnswerDAO::insert($user, $answers);
    }
}
