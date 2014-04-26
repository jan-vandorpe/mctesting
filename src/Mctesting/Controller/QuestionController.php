<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Model\Service\CategoryService;
use Mctesting\Model\Service\QuestionService;
use Mctesting\Exception\FormException;

/**
 * Description of QuestionController
 *
 * @author Thomas Deserranno
 */
class QuestionController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    /**
     * Controller action that handles the input form for a new question.
     * If the form was submitted then it is validated and further actions are
     * put in motion.
     * If the form was not submitted an empty form is rendered.
     * Categories and subcategories are supplied to populate a select box
     */
    public function create()
    {
        //build model
        //get categories, but only the ones with subcategories
        $categories = CategoryService::getAllExceptEmpty();
        //load subcategories
        foreach ($categories as $category) {
            $category->retrieveSubcategories();
        }
        //check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['questionform'])) {
            //handle form
            try {
                QuestionService::create($_POST);
            } catch (FormException $exc) {
                //render form with errors
                $this->render(
                        'question_create.html.twig',
                        array(
                            'categories' => $categories,
                            'exception' => $exc,
                            )
                        );
            }
        } else {
            //form was not submitted, render empty form for new question
            //render page
            $this->render('question_create.html.twig', array(
                'categories' => $categories,));
        }
    }
}
