<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Service\SubcategoryService;
use Mctesting\Model\Data\CategoryDAO;
use Mctesting\Model\Entity\Category;

/* * *** Author: Bert Mortier **** */

class CategoryService
{

    public static function getAll()
    {
        return CategoryDAO::selectAll();
    }

    public static function getAllActive()
    {
        return CategoryDAO::selectAllActive();
    }

    public static function getAllExceptEmpty()
    {
        return CategoryDAO::selectAllExceptEmpty();
    }

    public static function activateCategory($id)
    {
        CategoryDAO::activateById($id);
    }

    public static function deactivateCategory($id)
    {
        CategoryDAO::deactivateById($id);
    }

    public static function getById($id)
    {
        return CategoryDAO::selectById($id);
    }

    public static function create($category)
    {
        CategoryDAO::insert($category);
    }

    public static function validateCategory($categoryname)
    {
        return CategoryDAO::checkName($categoryname);
    }

    public static function getSubcategories($category)
    {

        $subcategories = SubcategoryService::getByCategory($category);
        $category->setSubcategories($subcategories);
    }

}
