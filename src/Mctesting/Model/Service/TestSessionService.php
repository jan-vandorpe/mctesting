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
    public static function getAll()
    {
        return TestSessionDAO::selectAll();
    }
    
    public static function getAllFiltered()
    {
        return TestSessionDAO::selectAllFiltered();
    }
    
    public static function getSessionsByTest($testId)
    {
        return TestSessionDAO::selectByTest($testId);
    }
    
    public static function getSessionByPW($password)
    {
        return TestSessionDAO::selectByPW($password);
    }
    
    public static function getById($id)
    {
        return TestSessionDAO::selectById($id);
    }
    
    
    public static function create($datum, $testid, $sessieww, $users)
    {
        
        return TestSessionDAO::insert($datum, $testid, $sessieww,$users);
    }
}
