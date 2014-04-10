<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\CategoryDAO;

/***** Author: Bert Mortier *****/

class CategoryService
{
    public static function getAll()
    {
        return CategoryDAO::selectAll();
    }
    
    public static function getById($id)
    {
        return CategoryDAO::selectById($id);
    }
    
    public static function create($category)
    {
        CategoryDAO::insert($category);
    }            
    
    public static function getWithSubcategories($category)
    {
        
    }
    
    
}
