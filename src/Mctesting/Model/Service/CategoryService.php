<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Service\SubcategoryService;
use Mctesting\Model\Data\CategoryDAO;
use Mctesting\Model\Entity\Category;

/* * *** Author: Bert Mortier **** */

class CategoryService
{

    //function return all categories
    public static function getAll()
    {
        return CategoryDAO::selectAll();
    }

    //function returns all active categories
    public static function getAllActive()
    {
        return CategoryDAO::selectAllActive();
    }

    //function returns all categories except those without subcategories
    public static function getAllExceptEmpty()
    {
        return CategoryDAO::selectAllExceptEmpty();
    }

    //function activates specific category
    public static function activateCategory($id)
    {
        CategoryDAO::activateById($id);
    }

    //function deactivates specific category    
    public static function deactivateCategory($id)
    {
        CategoryDAO::deactivateById($id);
    }

    //function retrieves category by id
    public static function getById($id)
    {
        return CategoryDAO::selectById($id);
    }

    //function creates specific category
    public static function create($category)
    {
        $category = ucfirst(strtolower($category));
        CategoryDAO::insert($category);
    }

    //function checks if category exists or not
    public static function validateCategory($categoryname)
    {
        return CategoryDAO::checkName($categoryname);
    }

    //function retrieves the subcategories of a category
    public static function getSubcategories($category)
    {

        $subcategories = SubcategoryService::getByCategory($category);
        $category->setSubcategories($subcategories);
    }

}
