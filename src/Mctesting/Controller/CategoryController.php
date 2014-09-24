<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\CategoryService;
use Mctesting\Model\Service\SubcategoryService;
use Mctesting\Model\Includes\FlashMessageManager;
use Mctesting\Model\Entity\Feedback;

/**
 * Description of Categoriecontroller
 * 
 * Controller that shows the Category & Subcategory page.
 *
 * @author Bram, Thomas & Bert
 */
class CategoryController extends AbstractController {

    function __construct($app) {
        parent::__construct($app);
    }

    public function go() {
        $this->newCatForm();
    }

    public function newCatForm() {
        $allcategories = CategoryService::getAll();
        $this->render('category.html.twig', array('allcategories' => $allcategories,
        ));
    }

    public function categoryList() {
        $allcategories = CategoryService::getAll();
        foreach ($allcategories as $category) {
            $category->retrieveSubcategories();
        }
        $this->render('categorylist.html.twig', array(
            'allcategories' => $allcategories,
        ));
    }

    public function newCategory() {
        $category = $_POST["newcat"];
        //checks if the new category variable is set and if it isn't already in the DB
        if ($category !== '' and CategoryService::validateCategory($category) == true) {
            //creates a new category
            CategoryService::create($category);
            $FMM = new FlashMessageManager();
            $FMM->setFlashMessage('Categorie succesvol toegevoegd', 1);
            header("location: go");
        } else {
            throw new ApplicationException('Er is een fout gebeurd in het toevoegen van een nieuwe categorie');
        }
    }

    public function newSubcategory() {
        //check if variables are set
        if (isset($_POST["subcat"]) && !empty($_POST["subcat"]) && isset($_POST["category"]) && !empty($_POST['category']) && $_POST["category"] !== NULL) {
            $subcategory = $_POST["subcat"];
            $categoryid = $_POST["category"];
        } else {
            throw new ApplicationException('Het subcategorie veld mag niet leeg zijn');
        }
        //check if subcategory is filled in and doesn't yet exist within the category
        if ($subcategory !== null && SubcategoryService::validateSubcategory($subcategory, $categoryid) == false) {
            //creates a new subcategory
            SubcategoryService::create($categoryid, $subcategory);
            $message = new Feedback();
            $message->setMessage('Subcategorie succesvol toegevoegd');
            $_SESSION['feedback'] = serialize($message);
            header("location: go");
        } else {
            //throw new ApplicationException('Subcategorie bestaat al');
        }
    }

    public function subcatvragen($arguments) {
        $subCatId = $arguments[0];

        $subcategory = SubcategoryService::getById($subCatId);

        $this->render('category_subcatvragen.html.twig', array(
            'subcategorie' => $subcategory,
        ));
    }

    public function inactive() {
        foreach ($_POST['subcatCheckbox'] as $check) {
            SubcategoryService::deactivateSubcategory($check);
            header("location: " . ROOT . "/category/categorylist");
        }
    }

    public function active() {
        foreach ($_POST['subcatCheckbox'] as $check) {
            SubcategoryService::activateSubcategory($check);
            header("location: " . ROOT . "/category/categorylist");
        }
    }

}
