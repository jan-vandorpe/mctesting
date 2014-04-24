<?php

namespace Mctesting\Controller;
use Mctesting\Model\Entity\TestSession;
use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;

/**
 * Description of homecontroller
 * 
 * Controller that shows the application homepage.
 *
 * @author Bram & Thomas
 */
class ChooseSessionController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
//    public function go()
//    {
//        //model
//        //$message1 = 'It works!';
//        //$message2 = 'It REALLY works!';
//        //$message3 = 'OMFG IT BLOODY WORKS! THAT\'S A-MAZE-ING! WOOT!';
//        //$message4 = '<b>help mij</b>';
//        //view
//        $this->render('home.html.twig', array(
//          //  'message1' => $message1,
//          //  'message2' => $message2,
//          //  'message3' => $message3,
//          //  'message4' => $message4,
//            ));
//        //print_r($_SESSION);
//        //var_dump($this->app->getUser());
//    }
    
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


    
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }
}
