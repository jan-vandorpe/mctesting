<?php
/** Index.php essentially functions as a front controller,
 * instanciating the application class and running the dispatcher.
 */

//require initial application code
require_once '../src/Framework/AbstractFramework.php';
require_once '../src/Framework/Application.php';

use Framework\Application;
use Framework\Exception\FrameworkException;
use Framework\Exception\DispatcherException;

//load helper functions
require_once '../src/Framework/Helper.php';

//start secure session
\Framework\sec_session_start();

//define application root
$appRoot = substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT']));
$appRoot = str_replace('\\', '/', $appRoot);
$appRoot = str_replace('/public', '', $appRoot);
define('ROOT', $appRoot);

/* Create application object
 * Application name must be identical to the application folder in src folder
 * (case sensitive), also supply the application root. It will be stored in the
 * application object for use in twig templates.
 */
$app = new Application('Mctesting', $appRoot);

//add Twig globals to allow direct access from any twig template
$app->getFrameworkEnvironment()->addGlobal('session', $_SESSION);
$app->getAppEnvironment()->addGlobal('session', $_SESSION);
$app->getFrameworkEnvironment()->addGlobal('app', $app);
$app->getAppEnvironment()->addGlobal('app', $app);

//attempt to run dispatcher
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
