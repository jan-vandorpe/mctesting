<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Model\Service\CategoryService;
use Mctesting\Model\Service\QuestionService;
use Mctesting\Model\Entity\Answer;
use Mctesting\Model\Includes\UploadManager;
use Mctesting\Model\Entity\Feedback;

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
    public function create($msg = null)
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
            'categories' => $categories,
            'msg' => $msg));
    }
    
    /**
     * Controller action that processes the input of a new question via the
     * input form (see create() action)
     */
    public function add()
    {    
      $questionMediaFileNames = array();
      if($_FILES['media']['error'][0]==0){
        /**
         * if question files have been selected
         * iterate and upload each of them
         * upload function returns a randomized filename
         * push that to $questionMediaFileNames array
         */
        $i = 0;
      foreach ($_FILES['media']['name'] as $value) {
        list($file,$error) = UploadManager::upload('media','../public/images/','jpg,jpeg,gif,png',$i);
        if($error) print $error;
        $i++;
        array_push($questionMediaFileNames, $file);
      }
      }
      
      $i = 0;
      $answersArray = array();
      foreach ($_POST['antwoord'] as $index => $text) {
        /**
         * for each answer create new Answer object and enter id and text
         * if a file has been chosen to accompany it the $_FILES array won't
         * be empty at that index, so we can upload that file
         * and add the randomized filename to the media attribute of the answer object
         * Then push the object to the answerArray
         */
        $answer = new Answer();
        $answer->setId($index);
        $answer->setText($text);
        if($_FILES['answerMedia']['error'][$index]==0){
          print $index;
        list($file,$error) = UploadManager::upload('answerMedia','../public/images/','jpg,jpeg,gif,png',$i);
        if($error) print $error;
        $answer->setMedia($file);
        }
        $i++;
        array_push($answersArray, $answer);
      }
      
      //assign and typecast variables
        $subcatId = (integer) $_POST['subcat'];
        $questionText = $_POST['vraag'];
        $questionText = ucfirst($questionText);
        $weight = (integer) $_POST['gewicht'];
        $correctAnswerId = (integer) $_POST['correctant'];

        //pass it along
        QuestionService::create($subcatId,$questionText,$weight,$correctAnswerId
                ,$answersArray,$questionMediaFileNames);
        $msg = new Feedback();
        $msg->setMessage('Vraag succesvol toegevoegd');
        $_SESSION['feedback'] = serialize($msg);
        header('location: '.ROOT.'/question/create');
        exit();
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
