<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\SubcategoryDAO;
use Mctesting\Model\Data\CategoryDAO;

/***** Author: Bert Mortier *****/

class SubcategoryService
{
    public static function getAll()
    {
        return SubcategoryDAO::selectAll();
    }
    
    public static function getById($catid,$subcatid)
    {
        return SubcategoryDAO::selectById($catid,$subcatid);
    }
    
    public static function getByCategoryId($category)
    {
        return SubcategoryDAO::selectByCategoryId($category);
    }   
    
    public static function newSubcategory($catid,$subcatid,$subcatnaam)
    {
        SubcategoryDAO::createNewSubcategory($catid,$subcatid,$subcatnaam);
    }     
    
}
