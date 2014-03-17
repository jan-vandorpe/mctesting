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
class ACLTestController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function go()
    {
        //model
        $message1 = 'It works! Access granted';
       
        
        //view
        $this->render('home.html.twig', array(
            'message1' => $message1,
            ));
    }
}
