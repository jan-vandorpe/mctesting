<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\UserSessionDAO;

/**
 * Description of TestSessionUserService
 *
 * @author cyber01
 */
class UserSessionService
{
    public static function getBySession($sessionId)
    {
        return UserSessionDAO::selectBySession($sessionId);
    }
    
    public static function create($sessionId, $RRNr)
    {
        return UserSessionDAO::insert($sessionId, $RRNr);
    }
}
