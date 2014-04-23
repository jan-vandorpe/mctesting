<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Model\Service\TestService;

/**
 * Description of TestController
 *
 * @author cyber01
 */

class TestController extends AbstractController
{
    public function runTest($testId)
    {
        //build model
        //retrieve full test (test info + all questions and answers
        $test = TestService::getActiveFullTestById(2);
        //store test in session for process method
        $_SESSION['test'] = serialize($test);
        
        //render page
        return $this->render('test_runtest.html.twig', array(
            'test' => $test,
        ));
    }
    
    public function process()
    {
        //retrieve test from session
        $test = unserialize($_SESSION['test']);
        
        //process user answers
        TestService::processAnswers($test, $_POST['answer']);
    }
}
