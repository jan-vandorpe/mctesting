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

    public function choosesession()
    {
        //model
        //$sessionlist= $_SESSION["sessionchoices"];
//        print('<pre>');
//        print_r($sessionlist);
//        print('</pre>');
        //view
        $this->render('choosesession.html.twig', array(
//            'sessionlist' => $sessionlist,
        ));
    }

    public function runTest($arguments)
    {
        //process arguments
        $testId = $arguments[0];
        $testSessionId = $arguments[1];

        //build model
        //retrieve full test (test info + all questions and answers
        $test = TestService::getActiveFullTestById($testId);
        $catname = TestService::getCatName($testId);

        //shuffle questions
        $test->shuffleQuestions();
        //shuffle answers
        $test->shuffleAnswers();

        //store in session for process method
        $_SESSION['test'] = serialize($test);
        $_SESSION['testsessionid'] = $testSessionId;
        $_SESSION['testid'] = $testId;

        //render page
        return $this->render('test_runtest.html.twig', array(
                    'test' => $test,
                    'catname' => $catname,
        ));
    }

    public function process()
    {
        //retrieve test from session
        $test = unserialize($_SESSION['test']);
        $testId = $_SESSION['testid'];
        $testSessionId = $_SESSION['testsessionid'];
        
        //retrieve testsesion from DB
        $user = UserService::unserializeFromSession();
        $userSessions = UserSessionService::getByUserANDSession($_SESSION['testsessionid'], $user->getRRnr());
        $userSession = $userSessions[0];
        
        //process user answers
        if (isset($_POST['answer']) && $_POST['answer'] != null) {
            TestService::processAnswers($test, $_POST['answer'], $userSession);
            //render confirm page
            $this->render('test_confirm.html.twig', array());
        } else {
            //redirect to runtest
            header("location: " . ROOT . "/test/runTest/$testId/$testSessionId");
        }
    }

}
