<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Entity\Test;
use Mctesting\Model\Data\TestDAO;

/**
 * Description of UserService
 *
 * @author Bram Peters
 */
class TestQuestionService
{
    
    public static function getAll()
    {
        return TestDAO::selectAll();
    }
    
    public static function insertCreatedTestSessionIntoDB($datum, $testid, $sessieww, $actief, $users,$afgelegd)
    {
        
        return TestDAO::insertSession($datum, $testid, $sessieww, $actief,$users,$afgelegd);
    }


    

    
}