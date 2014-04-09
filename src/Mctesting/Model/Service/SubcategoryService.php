<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\SubcategoryDAO;
use Mctesting\Model\Data\CategoryDAO;

/***** Author: Bert Mortier *****/

class SubcategoryService
{
    public static function getAll()
    {
        return CategoryDAO::selectAll();
    }
    
    public static function getById($id)
    {
        return SubcategoryDAO::selectById($id);
    }
    
    public static function getByCategoryId($category)
    {
        return SubcategoryDAO::selectByCategoryId($category);
    }   
    
    
}
