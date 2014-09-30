<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Service\SubcategoryService;
use Mctesting\Model\Data\CategoryDAO;
use Mctesting\Model\Entity\Category;
use Mctesting\Exception\ApplicationException;

/* * *** Author: Bert Mortier **** */

class CategoryService {

  //function return all categories
  public static function getAll() {
    return CategoryDAO::selectAll();
  }

  //function returns all active categories
  public static function getAllActive() {
    return CategoryDAO::selectAllActive();
  }

  //function returns all categories except those without subcategories
  public static function getAllExceptEmpty() {
    return CategoryDAO::selectAllExceptEmpty();
  }

  //function activates specific category
  public static function activateCategory($id) {
    CategoryDAO::activateById($id);
  }

  //function deactivates specific category    
  public static function deactivateCategory($id) {
    CategoryDAO::deactivateById($id);
  }

  //function retrieves category by id
  public static function getById($id) {
    return CategoryDAO::selectById($id);
  }

  public static function getByTestId($id) {
    return CategoryDAO::selectByTestId($id);
  }
  
  //function creates specific category
  public static function create($category) {
    $category = ucfirst(strtolower($category));
    CategoryDAO::insert($category);
  }

  //function checks if category exists or not and validates input
  public static function validateCategory($categoryname) {

    $name = $categoryname;
    //var_dump($name);
    $name = str_replace(' ', '', $name);
    //var_dump($name);
    $name = preg_replace('/[^a-zA-Z]/', '', $name);
    //var_dump($name);
    if (!ctype_alpha($name)) {
      throw new ApplicationException('Subcategorienaam mag niet enkel cijfers en leestekens bevatten');
    }
    if (strlen($categoryname) < 3 | strlen($categoryname) > 20) {
      throw new ApplicationException('Subcategorienaam moet tussen de 3 en 20 karakters bevatten');
    }
    return CategoryDAO::checkName($categoryname);
  }

  //function retrieves the subcategories of a category
  public static function getSubcategories($category) {

    $subcategories = SubcategoryService::getByCategory($category);
    $category->setSubcategories($subcategories);
  }

}
