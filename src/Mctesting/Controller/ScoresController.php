<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Model\Service\TestService;
use Mctesting\Model\Service\TestSessionService;
use Mctesting\Model\Service\UserSessionService;
use Mctesting\Model\Service\TestQuestionService;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Entity\Subcategory;
use Mctesting\Model\Includes\HelperFunctions;

/**
 * Description of ScoresController
 * 
 * Controller to show score reports
 *
 * @author cyber01
 */
class ScoresController extends AbstractController
{
  function __construct($app) {
        parent::__construct($app);
    }

  
  public function go(){
    $this->selectTest();
  }

    public function selectTest($arguments = "")
    {
      
      if($arguments && $arguments[0] === "input"){
        print_r($arguments);
        $tests = TestService::getAllWithSessions();

        //render page
        $this->render('scores_selecttest_input.html.twig', array(
            'tests' => $tests,
        ));
        
      } else {
         //build model
        //retrieve tests
        $tests = TestService::getAllWithSessions();

        //render page
        $this->render('scores_selecttest.html.twig', array(
            'tests' => $tests,
        ));
      }
    }

    public function showSessions($arguments)
    {
      if($arguments && $arguments[0] === "input"){
        print_r($arguments);
        $testsessions = TestSessionService::getSessionsByTest($_POST['selecttest']);
        $test = TestService::getById($_POST['selecttest']);

        //render page
        $this->render('scores_showsessions_input.html.twig', array(
            'testsessions' => $testsessions,
            'test' => $test,
        ));
        
      } else {
        //build model
        //retrieve all testsessions before today for testId
        $testsessions = TestSessionService::getSessionsByTest($_POST['selecttest']);
        //retrieve selected test
        $test = TestService::getById($_POST['selecttest']);

        //render page
        $this->render('scores_showsessions.html.twig', array(
            'testsessions' => $testsessions,
            'test' => $test,
        ));
      }
    }

    public function showSessionDetail($arguments)
    {
      if($arguments && $arguments[0] === "input"){
        
         //assign argument values
        $sessionId = $_POST['selectsession'];
        
        //build model
        //retrieve testsession
        $testSession = TestSessionService::getById($sessionId);
        //retrieve usersessions
        $userSessions = UserSessionService::getBySessionNotParticipated($sessionId);

        //render page
        $this->render('scores_showsessiondetail_input.html.twig', array(
            'testsession' => $testSession,
            'usersessions' => $userSessions,
        ));
        
      } else {
         //assign argument values
        $sessionId = $_POST['selectsession'];
        
        //build model
        //retrieve testsession
        $testSession = TestSessionService::getById($sessionId);
        //retrieve usersessions
        $userSessions = UserSessionService::getBySession($sessionId);

        //render page
        $this->render('scores_showsessiondetail.html.twig', array(
            'testsession' => $testSession,
            'usersessions' => $userSessions,
        ));
      }
    }
    
    public function showScoresRapport($arguments)
    {
        /**
         * Scores per gebruiker tonen
         */
        
        $sessionId = $arguments[0];
        $userId = $arguments[1];
        
        //build model
        //retrieve
        $userSession = UserSessionService::getByUserANDSession($sessionId, $userId);
        
        $_SESSION["usersession"] = serialize($userSession);
        if($userSession === false){
          throw new ApplicationException('Er zijn geen testsessies gevonden voor deze combinatie van gebruiker en sessie');
        }
        $testId = $userSession[0]->getTestSession()->getTest()->getTestId();
       
        
        //var_dump($userSession);
        //var_dump($subcategories);
        //var_dump($userId);
        
        if(isset($arguments[2]) && $arguments[2] === "input"){          
          $subcategories = TestQuestionService::getTestCatsByTestId($testId);
          $_SESSION["subcats"] = serialize($subcategories);
          //var_dump($subcategories);
          $this->render('scores_userrapport_input.html.twig', array(
            'usersession' => $userSession,
            'subcats' => $subcategories,
        ));
        }
        else {
          $subcategories = TestQuestionService::getAnsweredCats($sessionId, $userId, $testId);
        //render page
        $this->render('scores_userrapport.html.twig', array(
            'usersession' => $userSession,
            'subcats' => $subcategories,
        ));
      }
    }
    
    
    /**
     * Delibereer een gebruiker
     */
    public function delibereer($arguments) 
    {
        $sessionId = $arguments[0];
        $userId = $arguments[1];        
        
        UserSessionService::delibereer($sessionId, $userId);
        
        header("location: " . ROOT . "/scores/showScoresRapport/" . $sessionId . "/" . $userId);
    }
    /* show session for manual score input */
    public function showsessionsscoresentry(){
      
    }
    
    public function manualentry(){
      $userSession = unserialize($_SESSION["usersession"]);
      $subcats = unserialize($_SESSION['subcats']);
      
      $score = 0;
      $maxscore = $userSession[0]->getTestSession()->getTest()->getTestMaxScore();
      $result['subcategories'] = array();
      foreach($subcats as $subcat){
        $subcatId = $subcat->getId();
        if(isset($_POST["catid".$subcatId."score"]) && HelperFunctions::numbers_only($_POST["catid".$subcatId."score"]) === true ){
        $subcat->setScore($_POST["catid".$subcatId."score"]);
        //calculate subcat percentage
        $subcat->setPercentage(TestService::calculatePercentage($subcat->getScore(), $subcat->getMaxScore()));
        $score += $_POST["catid".$subcatId."score"];
        
        //because predecessor reasons, ::update uses this $results array in array thing instead of objects
        //so not much point in continuing to use objects to hold the variables
        $result['subcategories'][$subcatId]['score'] = $_POST["catid".$subcatId."score"];
        $result['subcategories'][$subcatId]['percentage'] = $subcat->getPercentage();
        } else {
          throw new ApplicationException('Gelieve alle scores correct in te vullen');
        }
      }
        //calculate overall test percentage
        $percentageTotal = TestService::calculatePercentage($score, $maxscore);      
      
        //calculate if user passed or failed
        $pass = TestService::calculatePassFailManualEntry($percentageTotal, $userSession, $subcats);
      
       //prepare usersession return values
        //set score
        $userSession[0]->setScore($score);
        
        //set percentage
        $userSession[0]->setPercentage($percentageTotal);

        //set answers, empty because only scores were entered
        $userSession[0]->setAnswers(array());
        
        //set participated
        $userSession[0]->setParticipated(true);
        
        //set passed
        $userSession[0]->setPassed($pass);
        
        //persist into DB
        UserSessionService::update($userSession[0],$result['subcategories']);
        //persist subcat results into NON EXISTENT TABLE 
        
        unset($_SESSION["usersession"]);
        unset($_SESSION["subcats"]);
        
    }

}
