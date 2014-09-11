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
    
    public static function getByUserANDSession($sessionId, $userId)
    {
        return UserSessionDAO::selectByUserAndSession($sessionId, $userId);
    }
    
    public static function create($sessionId, $RRNr)
    {
        return UserSessionDAO::insert($sessionId, $RRNr);
    }
    
    public static function update($userSession)
    {
        return UserSessionDAO::update($userSession);
    }
    
    public static function delibereer($sessionId, $userId)
    {
        return UserSessionDAO::delibereer($sessionId, $userId);
    }
}
