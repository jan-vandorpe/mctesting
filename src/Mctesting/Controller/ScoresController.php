<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Model\Service\TestService;

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
    
    public function showSessions($testId)
    {
        //build model
        //retrieve all testsessions before today for testId
        
        //render page
        $this->render('scores_showsessions.html.twig', array());
    }
    
    public function showSessionDetail($testsessionId)
    {
        //build model
        //retrieve testsession 
        
        //render page
        $this->render('scores_showsessiondetail.html.twig', array());
    }
}
