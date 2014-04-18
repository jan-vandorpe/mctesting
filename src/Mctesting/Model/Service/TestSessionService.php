<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\TestSessionDAO;

/**
 * Description of TestSessionService
 *
 * @author cyber01
 */

class TestSessionService
{
    public static function getSessionsByTest($testId)
    {
        return TestSessionDAO::selectByTest($testId);
    }
    
    public static function getById($id)
    {
        return TestSessionDAO::selectById($id);
    }
}
