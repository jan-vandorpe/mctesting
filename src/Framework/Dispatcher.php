<?php

namespace Framework;

use Framework\Exception\DispatcherException;
use Framework\Exception\SecurityException;
use Mctesting\Exception\ApplicationException;

/**
 * Description of Dispatcher
 * Dispatcher class takes apart the URI and attempts to load the requested
 * controller and method.
 * 
 * @author cyber02
 */
class Dispatcher
{

    protected $app;

    function __construct($app)
    {
        $this->app = $app;
    }

    public function run()
    {
        //process url, trim any leading and trailing slashes
        $url = trim($_SERVER['REQUEST_URI'], '/');
        //explode url and shift elements out until application folder is found
        $url = explode('/', $url);
        while ($url[0] != strtolower($this->app->getAppName())) {
            array_shift($url);
        }
        //shift application folder out, it is not necessary for dispatching a controller
        array_shift($url);
        //get controller name, if empty use default
        $requestedController = (!empty($url[0])) ? ucfirst(strtolower($url[0])) : 'Home';
        array_shift($url);
        //get method name, if empty use default
        $methodName = (!empty($url[0])) ? strtolower($url[0]) : 'go';
        array_shift($url);
        //get arguments, if empty set to null
        $arguments = (!empty($url)) ? $url : null;
        //set application controller namespace
        $namespace = $this->app->getAppName() . '\Controller\\';
        //set fully qualified controller name
        $controllerNameFQ = $namespace . $requestedController . 'Controller';
        //test if dispatcher autoloader can load controller
        if ($this->app->getAppLoader()->canLoadClass($controllerNameFQ)) {
            //create controller and pass along the application object
            $controller = new $controllerNameFQ($this->app);
            //test if requested method exists for created controller
            if (method_exists($controller, $methodName)) {
                try {
                    try {
                        //check if access is allowed to requested page(controller)
                        \Framework\check_access_control($requestedController);
                        //call method and pass arguments
                        $controller->$methodName($arguments);
                    } catch (SecurityException $ex) {
                        switch ($ex->getCode()) {
                            //Access denied
                            case '1':
                                throw new ApplicationException($ex->getMessage());
                                break;
                            default:
                                throw new ApplicationException('Oops, something went wrong. I know its cliché ...');
                                break;
                        }
                    }
                } catch (ApplicationException $ex) {
                  $_SESSION['feedback'] = serialize($ex);
                  header('Location:'.$_SERVER['HTTP_REFERER']);
                   // print($this->app->getAppEnvironment()->render('error.html.twig', array('exception' => $ex, 'back' => $_SERVER['HTTP_REFERER'])));
                }
            } else {
                throw new DispatcherException('Unknown method ' . $methodName);
            }
        } else {
            throw new DispatcherException('Unknown controller ' . $requestedController);
        }
    }
}
