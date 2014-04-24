<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Model\Service\TestService;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\UserSessionService;

/**
 * Description of TestController
 *
 * @author cyber01
 */

class TestController extends AbstractController
{
    public function runTest($arguments)
    {
        //process arguments
        $testId = $arguments[0];
        $testSessionId = $arguments[1];
        
        //build model
        //retrieve full test (test info + all questions and answers
        $test = TestService::getActiveFullTestById($testId);
        //store in session for process method
        $_SESSION['test'] = serialize($test);
        $_SESSION['testsessionid'] = $testSessionId;
        
        //render page
        return $this->render('test_runtest.html.twig', array(
            'test' => $test,
        ));
    }
    
    public function process()
    {
        //retrieve test from session
        $test = unserialize($_SESSION['test']);
        //retrieve testsesion from DB
        $user = UserService::unserializeFromSession();
        $userSessions = UserSessionService::getByUserANDSession($_SESSION['testsessionid'], $user->getRRnr());
        $userSession = $userSessions[0];
        //process user answers
        TestService::processAnswers($test, $_POST['answer'], $userSession);
        
        //render confirm page
        $this->render('test_confirm.html.twig', array());
    }
}
