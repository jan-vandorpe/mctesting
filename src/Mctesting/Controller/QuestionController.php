<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Model\Service\CategoryService;
use Mctesting\Model\Service\QuestionService;
use Mctesting\Model\Includes\UploadManager;

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
     * Controller action that shows the input form for a new question.
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
      $i = 0;
      foreach ($_FILES['media']['name'] as $value) {
        list($file,$error) = UploadManager::upload('media','../public/images/','jpg,jpeg,gif,png',$i);
        if($error) print $error;
        $i++;
      }
      
      $i = 0;
      foreach ($_FILES['answerMedia']['name'] as $value) {
        list($file,$error) = UploadManager::upload('answerMedia','../public/images/','jpg,jpeg,gif,png',$i);
        if($error) print $error;
        $i++;
      }
      
      
      
      
        //QuestionService::create($_POST);
        //header('location: '.ROOT.'/question/create/');
        //exit();
    }
    
    private function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
}
