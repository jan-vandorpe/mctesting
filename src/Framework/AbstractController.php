<?php

namespace Framework;

/**
 * Description of controller
 * 
 * Framework base controller class containing the application object
 * 
 * All controllers created in an application need to extend this class to have
 * access to the class loaders and twig environment.
 *
 * @author Thomas
 */
abstract class AbstractController {

    protected $app;

    function __construct($app) {
        $this->app = $app;
    }

    public function render($view, $model) {
        print($this->app->getAppEnvironment()->render($view, $model));
    }

}
