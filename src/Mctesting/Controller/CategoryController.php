<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\CategoryService;

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
        if ($category !== null and CategoryService::validateNewCategory($category) == true)
        {
            CategoryService::create($category);
            header("location: categorylist");
        } else
        {
            print ("");
        }
    }
    public function newSubcategory()
    {
        $subcategory = $_POST["subcat"];
        if ($category !== null and CategoryService::validateNewCategory($category) == true)
        {
            CategoryService::create($category);
            header("location: categorylist");
        } else
        {
            print ("");
        }
    }
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }

}
