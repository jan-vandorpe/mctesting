<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\TestSubcatDAO;

/**
 * Description of TestSessionService
 *
 * @author cyber01
 */

class TestSubcatService
{    
    
    public static function create($testid, $subcat)
    {
        return TestSubcatDAO::insert($testid, $subcat);
    }
    
    public static function getByTestANDSubcategory($testId, $subcatId)
    {
        return TestSubcatDAO::selectByTestANDSubcategory($testId, $subcatId);
    }
    
    public static function remove($testid)
    {        
        return TestSubcatDAO::delete($testid);
    }
}
