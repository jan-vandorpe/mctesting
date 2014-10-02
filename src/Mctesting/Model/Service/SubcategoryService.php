<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\SubcategoryDAO;
use Mctesting\Exception\ApplicationException;

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
        $name = $subcategoryname;
        //var_dump($name);
        $name = str_replace(' ','', $name);
        //var_dump($name);
        $name = preg_replace('/[^a-zA-Z]/', '', $name);
        //var_dump($name);
        if(!ctype_alpha($name)){
          throw new ApplicationException('Subcategorienaam mag niet enkel cijfers en leestekens bevatten');
        }
        if(strlen($subcategoryname)<3 | strlen($subcategoryname)>20 ){
          throw new ApplicationException('Subcategorienaam moet tussen de 3 en 20 karakters bevatten');
        }
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
        $subcatnaam = ucfirst($subcatnaam);
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
    
    public static function getByCategoryIdQuestionsNotInTest($catid)
    {
        return SubcategoryDAO::selectByCategoryIdQuestionsNotInTest($catid);
    }
    
    public static function getBySubCatIdQNIT($subcatid){
      return SubcategoryDAO::selectByIdQNIT($subcatid);
    }
    
    public static function getByTest($testid)
    {
        return SubcategoryDAO::selectByTest($testid);
    }

}
