<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\SubcategoryDAO;

/* * *** Author: Bert Mortier **** */

class SubcategoryService
{

    //function return all subcategories
    public static function getAll()
    {
        return SubcategoryDAO::selectAll();
    }

    //function returns all active subcategories
    public static function getAllActive()
    {
        return SubcategoryDAO::selectAllActive();
    }

    //function retrieves subcategory by id
    public static function getById($subcatid)
    {
        return SubcategoryDAO::selectById($subcatid);
    }

    //function checks if subcategory exists or not
    public static function validateSubcategory($subcategoryname, $categoryid)
    {
        return SubcategoryDAO::checkName($subcategoryname, $categoryid);
    }

    public static function getByCategoryId($catid)
    {
        return SubcategoryDAO::selectByCategoryId($catid);
    }

    //function retrieve all the active subcategories of a category
    public static function getActiveByCategoryId($catid)
    {
        return SubcategoryDAO::selectActiveByCategoryId($catid);
    }

    //function creates a new subcategory
    public static function create($catid, $subcatnaam)
    {
        $subcatnaam = ucfirst(strtolower($subcatnaam));
        SubcategoryDAO::insert($catid, $subcatnaam);
    }

    //function activates a subcategory
    public static function activateSubcategory($id)
    {
        SubcategoryDAO::activateById($id);
    }

    //function deactivates a subcategory
    public static function deactivateSubcategory($id)
    {
        SubcategoryDAO::deactivateById($id);
    }

}
