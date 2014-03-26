<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\UsergroupDAO;

/**
 * Description of UsergroupService
 *
 * @author Thomas Deserranno
 */
class UsergroupService
{
    public static function getAll()
    {
        return UsergroupDAO::selectAll();
    }
    
    public static function getById($id)
    {
        return UsergroupDAO::selectById($id);
    }
}
