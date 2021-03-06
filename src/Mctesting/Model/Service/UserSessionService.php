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
    
    public static function getUsersBySession($sessionId)
    {
        return UserSessionDAO::selectUsersBySession($sessionId);
    }
    
    public static function getByUserANDSession($sessionId, $userId)
    {
        return UserSessionDAO::selectByUserAndSession($sessionId, $userId);
    }
    
    public static function getByUser($userId)
    {
        return UserSessionDAO::selectByUser($userId);
    }
    
    public static function create($sessionId, $RRNr)
    {
        return UserSessionDAO::insert($sessionId, $RRNr);
    }
    
    public static function remove($sessionId)
    {
        return UserSessionDAO::delete($sessionId);
    }
    
    public static function update($userSession, $subcatResults)
    {
        return UserSessionDAO::update($userSession, $subcatResults);
    }
    
    public static function delibereer($sessionId, $userId)
    {
        return UserSessionDAO::delibereer($sessionId, $userId);
    }
    
    public static function getBySessionNotParticipated($sessionId)
    {
        return UserSessionDAO::selectBySessionNotParticipated($sessionId);
    }
}
