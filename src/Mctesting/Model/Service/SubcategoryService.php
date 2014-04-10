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
    
    public static function getByCategoryId($catid)
    {
        return SubcategoryDAO::selectByCategoryId($catid);
    }   
    
    public static function create($catid,$subcatid,$subcatnaam)
    {
        SubcategoryDAO::insert($catid,$subcatid,$subcatnaam);
    }     
    
}
