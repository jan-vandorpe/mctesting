<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\SubcategoryDAO;

/* * *** Author: Bert Mortier **** */

class SubcategoryService
{

    public static function getAll()
    {
        return SubcategoryDAO::selectAll();
    }

    public static function getAllActive()
    {
        return SubcategoryDAO::selectAllActive();
    }

    public static function getById($subcatid)
    {
        return SubcategoryDAO::selectById($subcatid);
    }

    public static function validateSubcategory($subcategoryname, $categoryid)
    {
        return SubcategoryDAO::checkName($subcategoryname, $categoryid);
    }

    public static function getByCategoryId($catid)
    {
        return SubcategoryDAO::selectByCategoryId($catid);
    }

    public static function getActiveByCategoryId($catid)
    {
        return SubcategoryDAO::selectActiveByCategoryId($catid);
    }

    public static function create($catid, $subcatnaam)
    {
        $subcatnaam = ucfirst(strtolower($subcatnaam));
        SubcategoryDAO::insert($catid, $subcatnaam);
    }

    public static function activateSubcategory($id)
    {
        SubcategoryDAO::activateById($id);
    }

    public static function deactivateSubcategory($id)
    {
        SubcategoryDAO::deactivateById($id);
    }

}
