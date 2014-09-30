<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Model\Service\CategoryService;
use Mctesting\Model\Service\QuestionService;
use Mctesting\Model\Entity\Answer;
use Mctesting\Model\Includes\UploadManager;
use Mctesting\Model\Includes\FlashMessageManager;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Entity\Question;
use Mctesting\Model\Service\AnswerService;

/**
 * Description of QuestionController
 *
 * @author Thomas Deserranno
 */
class QuestionController extends AbstractController {

  function __construct($app) {
    parent::__construct($app);
  }

  /**
   * Controller action that shows the input form for a new question.
   * Categories and subcategories are supplied to populate a select box
   */
  public function create($msg = null) {
    //build model
    //get categories, but only the ones with subcategories
    $categories = CategoryService::getAllExceptEmpty();
    //load subcategories
    foreach ($categories as $category) {
      $category->retrieveSubcategories();
    }
    $question = null;
    if(isset($_SESSION['tempQuestion'])){
      $question = unserialize($_SESSION['tempQuestion']);
    }
    //render page
    $this->render('createquestion.html.twig', array(
        'categories' => $categories,
        'msg' => $msg,
        'question' => $question,
    ));
    //unsets the session variables used to customize the UI
    unset($_SESSION['nopopup']);
    unset($_SESSION['subcatprevious']);
    unset($_SESSION['tempQuestion']);
  }

  /**
   * Controller action that processes the input of a new question via the
   * input form (see create() action)
   */
  public function add() {
    if (isset($_POST['nopopup'])) {
      //used to hide the success popup on new question create page after successful creation
      $_SESSION['nopopup'] = true;
    }
    $questionMediaFileNames = array();
    if ($_FILES['media']['error'][0] == 0) {
      /**
       * if question files have been selected
       * iterate and upload each of them
       * upload function returns a randomized filename
       * push that to $questionMediaFileNames array
       */
      $i = 0;
      foreach ($_FILES['media']['name'] as $value) {
        list($file, $error) = UploadManager::upload('media', '../public/images/', 'jpg,jpeg,gif,png', $i);
        if ($error) {
          throw new ApplicationException($error);
        }
        $i++;
        array_push($questionMediaFileNames, $file);
      }
    }

    //assign and typecast variables
    $subcatId = (integer) $_POST['subcat'];
    //used to preselect the 'previous' subcat on new question creation
    $questionText = $_POST['vraag'];
    $weight = (integer) $_POST['gewicht'];
    $correctAnswerId = (integer) $_POST['correctant'];

    $question = new Question();
    $question->setCorrectAnswer($correctAnswerId);
    $question->setMedia($questionMediaFileNames);
    $question->setSubcategory($subcatId);
    $question->setText($questionText);
    $question->setWeight($weight);
    $_SESSION['tempQuestion'] = serialize($question);

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
      if ($_FILES['answerMedia']['error'][$index] == 0) {
        //print $index;
        list($file, $error) = UploadManager::upload('answerMedia', '../public/images/', 'jpg,jpeg,gif,png', $i);
        if ($error) {
          throw new ApplicationException($error);
        }
        $answer->setMedia($file);
      }
      $i++;
      array_push($answersArray, $answer);
    }
    $question->setAnswers($answersArray);
    $_SESSION['tempQuestion'] = serialize($question);

    //pass it along
    QuestionService::create($subcatId, $questionText, $weight, $correctAnswerId
            , $answersArray, $questionMediaFileNames);
    if ($_SESSION['nopopup'] != true) {
      $msg = new FlashMessageManager();
      $msg->setFlashMessage('Vraag succesvol toegevoegd' . $_SESSION['nopopup'], 1);
    }
    header('location: ' . ROOT . '/question/create');
    exit();
  }

  private function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i = 0; $i < $file_count; $i++) {
      foreach ($file_keys as $key) {
        $file_ary[$i][$key] = $file_post[$key][$i];
      }
    }

    return $file_ary;
  }

  public function editList() {
    $allcategories = CategoryService::getAll();
    foreach ($allcategories as $category) {
      $category->retrieveSubcategories();
    }
    $this->render('editQuestionsCatList.html.twig', array(
        'allcategories' => $allcategories,
    ));
  }

  public function editQuestion($arguments) {
    $questionId = $arguments[0];

    $question = QuestionService::getById($questionId);
    $categories = CategoryService::getAllExceptEmpty();
    foreach ($categories as $category) {
      $category->retrieveSubcategories();
    }
    $this->render('editQuestion.html.twig', array(
        'categories' => $categories,
        'question' => $question,
    ));
  }

  public function addedited() {
    $questionId = $_POST['questionId'];
    $oldQuestion = QuestionService::getById($_POST['questionId']);
    $editedQuestion = new Question();

    //QUESTION
    //Question MEDIA
    $questionMediaFileNames = array();
    $previousMedia = $oldQuestion->getMedia();
    if (isset($_POST['oldMedia'])) {
      //if any pictures are to be retained, this will be set
      $oldMedia = $_POST['oldMedia'];
      foreach ($oldMedia as $file) {
        if (($key = array_search($file, $previousMedia)) !== false) {
          //unset from previousmedia list if found, eventually this list will only contain the images to be deleted or it will be empty
          unset($previousMedia[$key]);
          //push found file to mediafilenames, as it is still in
          array_push($questionMediaFileNames, $file);
          echo 'files still in play: ' . $file . '<br>';
        }
      }
    }
    //after removing the files still in play, possibly none, delete all remaining files
    foreach ($previousMedia as $fileToBeDeleted) {
      echo 'files to be deleted: ' . $fileToBeDeleted . '<br>';
      UploadManager::delete($fileToBeDeleted);
      //QuestionService::deleteQuestionMedia($fileToBeDeleted, $questionId);
      //QuestionService delete from DB
    }

    /**
     * if question files [newMedia] have been selected
     * iterate and upload each of them
     * upload function returns a randomized filename
     * push that to $questionMediaFileNames array
     */
    $i = 0;
    foreach ($_FILES['newQMedia']['tmp_name'] as $index => $value) {
      if ($_FILES['newQMedia']['error'][$index] == 0) {
        list($file, $error) = UploadManager::upload('newQMedia', '../public/images/', 'jpg,jpeg,gif,png', $i);
        if ($error) {
          throw new ApplicationException($error);
        }
        $i++;
        array_push($questionMediaFileNames, $file);
        echo 'new files added to question: ' . $file . '<br>';
      }
    }
    $editedQuestion->setMedia($questionMediaFileNames);

    //Question TEXT
    if (isset($_POST['antwoord'])) {
      $editedQuestion->setText($_POST['vraag']);
    } else {
      throw new ApplicationException('Gelieve een vraag in te vullen');
    }

    //ANSWERS
    $answersArray = array();
    $i = 0;
    if (isset($_POST['antwoord'])) {
      foreach ($_POST['antwoord'] as $index => $text) {
        //echo 'answer ' . $index . '<br>';
        /**
         * for each answer create new Answer object and enter id and text
         * if a file has been chosen to accompany it the $_FILES array won't
         * be empty at that index, so we can upload that file
         * and add the randomized filename to the media attribute of the answer object
         * Then push the object to the answerArray
         */
        $answer = new Answer();
        //Answer INDEX
        $answer->setId($index);
        //Answer TEXT
        $answer->setText($text);
        //Answer MEDIA
        if (isset($_POST['oldAnswer' . $index . 'Media'])) {
          $oldAnswerMedia = $_POST['oldAnswer' . $index . 'Media'];
          if ($_POST['inputText' . $index] === $oldAnswerMedia) {
            //all is well, no changes
            $answer->setMedia($oldAnswerMedia);
            //echo 'no changes for answer ' . $index . '<br>';
          } elseif ($_FILES['answerMedia']['error'][$index] == 4) {
            //image was deleted and there used to be one
            $answer->setMedia(null);
            //echo 'delete old image for answer ' . $index . '<br>';
            //delete from server and remove from DB
            UploadManager::delete($oldAnswerMedia);
            //AnswerService::deleteAnswerMedia($oldAnswerMedia, $questionId, $index);
          } elseif ($_FILES['answerMedia']['error'][$index] == 0) {
            //there was an image and it's been replaced
            //echo 'delete old image and a new file to upload for answer ' . $index . '<br>';
            list($file, $error) = UploadManager::upload('answerMedia', '../public/images/', 'jpg,jpeg,gif,png', $i);
            if ($error) {
              throw new ApplicationException($error);
            }
            $answer->setMedia($file);
            //delete via uploadmanager and remove from DB
            UploadManager::delete($oldAnswerMedia);
          }
        } elseif ($_FILES['answerMedia']['error'][$index] == 0) {
          //new file to upload
          //echo 'new file to upload for answer ' . $index . '<br>';
          list($file, $error) = UploadManager::upload('answerMedia', '../public/images/', 'jpg,jpeg,gif,png', $i);
          if ($error) {
            throw new ApplicationException($error);
          }
          $answer->setMedia($file);
        } else {
          //no new file uploaded and there wasn't an image before either
        }
        $i++;
        array_push($answersArray, $answer);
      }
      //ADD TO EDITED QUESTION OBJECT
      $editedQuestion->setAnswers($answersArray);
    } else {
      throw new ApplicationException('Gelieve de antwoorden in te vullen');
    }

    //QUESTION SUBCATEGORY
    $subcatId = (integer) $_POST['subcat'];
    $editedQuestion->setSubcategory($subcatId);
    $weight = (integer) $_POST['gewicht'];
    $editedQuestion->setWeight($weight);
    $correctAnswerId = (integer) $_POST['correctant'];
    $editedQuestion->setCorrectAnswer($correctAnswerId);
    $editedQuestion->setId($questionId);

    QuestionService::updateQuestion($editedQuestion);
    $msg = new FlashMessageManager();
    $msg->setFlashMessage('Vraag succesvol aangepast', 1);
    header('location: ' . ROOT . '/question/editquestion/' . $questionId);
    exit();
  }

}
