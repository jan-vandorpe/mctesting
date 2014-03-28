<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Entity\User;

/**
 * Description of UserService
 *
 * @author Thomas Deserranno
 */
class UserService
{
    public static function serializeToSession($user)
    {
        $_SESSION['user'] = serialize($user);
    }
    
    public static function unserializeFromSession()
    {
        $user = unserialize($_SESSION['user']);
        
        return $user;
    }
}
