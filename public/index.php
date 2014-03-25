<?php
/** Index.php essentially functions as a front controller,
 * instanciating the application class and running the application
 */

// Initialize application
require_once '../src/framework/abstractframework.php';
require_once '../src/framework/application.php';

use Framework\Application;
//use Framework\Helper;
use Framework\Exception\FrameworkException;
use Framework\Exception\DispatcherException;

 //load helper functions
//        $this->helper = new Helper;
require_once '../src/Framework/Helper.php';

//start secure session
//$app->getHelper()->sec_session_start();
/*$app->getHelper()->*/\Framework\sec_session_start();

//appname must be identical to the application folder in src folder(case sensitive)
$app = new Application('Mctesting');


//add SESSION as Twig global to allow direct access from any twig template
$app->getFrameworkEnvironment()->addGlobal('session', $_SESSION);
$app->getAppEnvironment()->addGlobal('session', $_SESSION);

try {
   
    //dispatch requested controller
    $app->getDispatcher()->run();

} catch (DispatcherException $ex) {
    $app->render('error.html.twig', array('exception' => $ex));
} catch (FrameworkException $ex) {
    $app->render('error.html.twig', array('exception' => $ex));
} catch (Exception $ex) {
    $app->render('error.html.twig', array('exception' => $ex));
}
