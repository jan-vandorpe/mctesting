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
    
    /**
     * Controller action that shows the input form for a new question.
     * Categories and subcategories are supplied to populate a select box
     */
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
    
    /**
     * Controller action that processes the input of a new question via the
     * input form (see create() action)
     */
    public function add()
    {
        QuestionService::create($_POST);
    }
}