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
class HomeController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function go()
    {
        //render page
        $this->render('home.html.twig', array());
    }    
}
