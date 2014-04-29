<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\CategoryService;
use Mctesting\Model\Service\SubcategoryService;

/**
 * Description of Categoriecontroller
 * 
 * Controller that shows the Category & Subcategory page.
 *
 * @author Bram, Thomas & Bert
 */
class CategoryController extends AbstractController
{

    function __construct($app)
    {
        parent::__construct($app);
    }

    public function go()
    {
        $allcategories = CategoryService::getAll();
        $this->render('category.html.twig', array('allcategories' => $allcategories,
        ));
    }

    public function categoryList()
    {
        $allcategories = CategoryService::getAll();
        foreach ($allcategories as $category)
        {
            $category->retrieveSubcategories();
        }
        $this->render('categorylist.html.twig', array(
            'allcategories' => $allcategories,
        ));
    }

    public function newCategory()
    {
        $category = $_POST["newcat"];
        //checks if the new category variable is set and if it isn't already in the DB
        if ($category !== null and CategoryService::validateCategory($category) == true)
        {     
            //creates a new category
            CategoryService::create($category);
            header("location: go");
        } else
        {
            throw new ApplicationException('Er is een fout gebeurd in het toevoegen van een nieuwe categorie');
        }
    }

    public function newSubcategory()
    {
        //check if variables are set
        if (isset($_POST["subcat"]) && isset($_POST["category"]) && $_POST["category"] !== NULL)
        {
            $subcategory = $_POST["subcat"];
            $categoryid = $_POST["category"];
        } else
        {
            throw new ApplicationException('Nieuwe subcategorie en categorie zijn niet geldig ingevoerd');
        }
        //check if subcategory is filled in and doesn't yet exist within the category
        if ($subcategory !== null && SubcategoryService::validateSubcategory($subcategory, $categoryid) == false)
        {
            //creates a new subcategory
            SubcategoryService::create($categoryid, $subcategory);
            header("location: go");
        } else
        {
            
        }
    }

    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }

}
