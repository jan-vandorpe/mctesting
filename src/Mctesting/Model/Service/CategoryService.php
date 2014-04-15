<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Service\SubcategoryService;
use Mctesting\Model\Data\CategoryDAO;
use Mctesting\Model\Entity\Category;

/* * *** Author: Bert Mortier **** */

class CategoryService {

    public static function getAll() {
        return CategoryDAO::selectAll();
    }

    public static function getById($id) {
        return CategoryDAO::selectById($id);
    }

    public static function create($category) {
        CategoryDAO::insert($category);
    }

    public static function validateNewCategory($categoryname){
   return CategoryDAO::checkName($categoryname);
    }
    
    
    
    public static function getSubcategories($category) {

        $subcategories = SubcategoryService::getByCategory($category);
        $category->setSubcategories($subcategories);
    }

}
