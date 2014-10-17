<?php

namespace Framework;

use Doctrine\Common\ClassLoader;
use Twig_Autoloader;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Framework\AbstractFramework;
use Framework\Dispatcher;
use Mctesting\Model\Service\UserService;

/**
 * Description of Application
 * Application class that instanciates the necessary Doctrine autoloader,
 * Twig environment and loads Helper class and config file
 * for the application.
 *
 * @author Thomas
 */
class Application extends AbstractFramework {

    protected $appName;
    protected $appLoader;
    protected $appEnvironment;
    protected $dispatcher;
    protected $user;
    protected $root;

    function __construct($appName, $appRoot) {
        //call framework constructor
        parent::__construct();
        $this->appName = $appName;
        $this->root = $appRoot;

        //initialize Doctrine classloader for application
        $this->appLoader = new ClassLoader($appName, '../src');
        $this->appLoader->register();

        //Initialize Twig environment for application
        require_once '../vendor/Twig/Autoloader.php';
        Twig_Autoloader::register();
        $twigLoader = new Twig_Loader_Filesystem('../src/' . $appName . '/view');
        $this->appEnvironment = new Twig_Environment($twigLoader, array('debug' => true));
        $this->appEnvironment->addExtension(new \Twig_Extension_Debug());

        //load application config file
        require_once '../src/' . $appName . '/Config/Config.php';

        //load dispatcher
        $this->dispatcher = new Dispatcher($this);

        //initialize user
        $user = null;
        if (isset($_SESSION['user'])) {
            $user = UserService::unserializeFromSession();
        }
        $this->user = $user;

        if (DEBUG == true) {
            ini_set('display_errors', 'On');
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', 'Off');
            error_reporting(0);
        }
    }

    public function getRoot() {
        return $this->root;
    }

    public function setRoot($root) {
        $this->root = $root;
    }

    public function getAppName() {
        return $this->appName;
    }

    public function getAppLoader() {
        return $this->appLoader;
    }

    public function getDispatcher() {
        return $this->dispatcher;
    }

    public function getUrl() {
        return '/' . $this->getAppName();
    }

    public function getAppEnvironment() {
        return $this->appEnvironment;
    }

    public function render($view, $model) {
        print($this->getFrameworkEnvironment()->render($view, $model));
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

}
