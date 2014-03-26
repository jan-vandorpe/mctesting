<?php

namespace Mctesting\Controller;
use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;

/**
 * Description of homecontroller
 * 
 * Controller that shows the application homepage.
 *
 * @author Thomas
 */
class HomeController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function go()
    {
        //model
        $message1 = 'It works!';
        $message2 = 'It REALLY works!';
        $message3 = 'OMFG IT BLOODY WORKS! THAT\'S A-MAZE-ING! WOOT!';
        
        //view
        $this->render('home.html.twig', array(
            'message1' => $message1,
            'message2' => $message2,
            'message3' => $message3,
            ));
    }
    
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }
}