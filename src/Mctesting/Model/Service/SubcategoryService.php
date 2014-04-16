<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\SubcategoryDAO;
use Mctesting\Model\Data\CategoryDAO;

/* * *** Author: Bert Mortier **** */

class SubcategoryService
{

    public static function getAll()
    {
        return SubcategoryDAO::selectAll();
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

    public static function create($catid, $subcatnaam)
    {
        SubcategoryDAO::insert($catid, $subcatnaam);
    }

}
