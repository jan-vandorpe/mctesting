<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Entity\Test;
use Mctesting\Model\Data\TestDAO;

/**
 * Description of UserService
 *
 * @author Bram Peters
 */
class TestService
{
    
    public static function getAll()
    {
        return TestDAO::selectAll();
    }
    
    public static function getById($id)
    {
        return TestDAO::selectById($id);
    }
    
    public static function create($testname, $testduration, $questioncount, $maxscore,$passpercentage, $adminId, $questions, $subcatlist)
    {
        
        return TestDAO::insert($testname, $testduration, $questioncount, $maxscore,$passpercentage, $adminId, $questions, $subcatlist);
    }


    

    
}
