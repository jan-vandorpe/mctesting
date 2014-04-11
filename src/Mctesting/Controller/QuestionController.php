<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Model\Service\CategoryService;
use Mctesting\Model\Service\QuestionService;

/**
 * Description of QuestionController
 *
 * @author cyber01
 */
class QuestionController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function create()
    {
        //build model
        //get categories
        $categories = CategoryService::getAll();
        //load subcategories
        foreach ($categories as $category) {
            $category->retrieveSubcategories();
        }

        //render page
        $this->render('createquestion.html.twig', array(
            'categories' => $categories,));
    }
    
    public function add()
    {
//        print '<pre>';
//        print $_POST['subcat'];
//        print $_POST['vraag'];
//        foreach ($_POST['antwoord'] as $antwoord) {
//            print $antwoord;
//        }
//        foreach ($_POST['media'] as $media) {
//            print $media;
//        }
//        print '</pre>';
        QuestionService::create($_POST);
    }
}
