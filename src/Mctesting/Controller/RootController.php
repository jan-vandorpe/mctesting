<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Model\Service\TestService;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\UserSessionService;

/**
 * Description of RController
 *
 * @author cyber01
 */
class RootController extends AbstractController
{
    public function go()
    {
        $root['ROOT'] = ROOT;
        $root['RootController_dirname'] = dirname(__FILE__);
        $root['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
        
        
        print '<pre>';
        print_r($root);
        print '</pre>';
        
        $this->render('home.html.twig', array());
    }
}
