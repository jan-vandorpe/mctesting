<?php

namespace Mctesting\Controller;
use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\TestService;
use Mctesting\Model\Service\UserService;

/**
 * Description of homecontroller
 * 
 * Controller that shows the application homepage.
 *
 * @author Bram & Thomas
 */
class TestsController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function go()
    {
        //model
        $message1 = 'Landingspagina voor alles ivm de tests (hier zou je normaal niet moeten komen)';
        $message2 = "";

        //view
        $this->render('tests.html.twig', array(
            'message1' => $message1,
            'message2' => $message2,

            ));
        //print_r($_SESSION);
        //var_dump($this->app->getUser());
    }
    public function testlink()
    {
        //model
        //$message1 = 'It works!';
        $allTest = TestService::getAll();
        $allUsers = UserService::getAllUsers();

        //view
        $this->render('testlink.html.twig', array(
          //  'message1' => $message1,
            'allTest'=>$allTest,
            'allUsers'=>$allUsers,

            ));
        //print_r($_SESSION);
        //var_dump($this->app->getUser());
    }

    
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }
}
