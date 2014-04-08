<?php

namespace Mctesting\Controller;
use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;

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

        //view
        $this->render('tests.html.twig', array(
            'message1' => $message1,

            ));
        //print_r($_SESSION);
        //var_dump($this->app->getUser());
    }
    public function lists()
    {
        //model
        //$message1 = 'It works!';

        //view
        $this->render('tests.html.twig', array(
          //  'message1' => $message1,

            ));
        //print_r($_SESSION);
        //var_dump($this->app->getUser());
    }

    
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }
}
