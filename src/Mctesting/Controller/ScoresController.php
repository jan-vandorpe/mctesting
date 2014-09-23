<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Model\Service\TestService;
use Mctesting\Model\Service\TestSessionService;
use Mctesting\Model\Service\UserSessionService;
use Mctesting\Model\Service\TestQuestionService;
use Mctesting\Exception\ApplicationException;

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

    public function selectTest()
    {
        //build model
        //retrieve tests
        $tests = TestService::getAll();

        //render page
        $this->render('scores_selecttest.html.twig', array(
            'tests' => $tests,
        ));
    }

    public function showSessions()
    {
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

    public function showSessionDetail()
    {
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
        if($userSession === false){
          throw new ApplicationException('Er zijn geen testsessies gevonden voor deze combinatie van gebruiker en sessie');
        }
        $testId = $userSession[0]->getTestSession()->getTest()->getTestId();
        $subcategories = TestQuestionService::getAnsweredCats($sessionId, $userId, $testId);
        //var_dump($userSession);
        //var_dump($subcategories);
        //var_dump($userId);
        
        //render page
        $this->render('scores_userrapport.html.twig', array(
            'usersession' => $userSession,
            'subcats' => $subcategories,
        ));
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

}
