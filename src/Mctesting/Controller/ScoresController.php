<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Model\Service\TestService;
use Mctesting\Model\Service\TestSessionService;
use Mctesting\Model\Service\UserSessionService;

/**
 * Description of ScoresController
 *
 * @author cyber01
 */
class ScoresController extends AbstractController
{
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
        $testsessions = TestSessionService::getSessionsByTest($_POST["selecttest"]);
        
        
        //render page
        $this->render('scores_showsessions.html.twig', array(
            'testsessions' => $testsessions,
        ));
    }
    
    public function showSessionDetail($arguments)
    {
        $sessionId = $arguments[0];
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
