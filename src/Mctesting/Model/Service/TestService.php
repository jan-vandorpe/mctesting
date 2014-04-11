<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Entity\User;
use Mctesting\Model\Data\TestDAO;

/**
 * Description of UserService
 *
 * @author Thomas Deserranno
 */
class TestService
{
    
    public static function getAll()
    {
        return TestDAO::selectAll();
    }
    
    
}