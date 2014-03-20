<?php
namespace Framework;

use Doctrine\Common\ClassLoader;
use Twig_Autoloader;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Framework\AbstractFramework;
use Framework\Helper;
use Framework\Dispatcher;

/**
 * Description of Application
 * Application class that instanciates the necessary Doctrine autoloader,
 * Twig environment and loads Helper class and config file
 * for the application.
 *
 * @author cyber02
 */
class Application extends AbstractFramework
{
    protected $appName;
    protected $appLoader;
//    protected $envLoader;
    protected $appEnvironment;
    protected $helper;
    protected $dispatcher;
            
    function __construct($appName)
    {
        //call framework constructor
        parent::__construct();
        $this->appName = $appName;
        
        //initialize Doctrine classloader for application
        $this->appLoader = new ClassLoader($appName, '../src');
        $this->appLoader->register();
        
        //Initialize Twig environment for application
        require_once '../vendor/Twig/Autoloader.php';
        Twig_Autoloader::register();
        $twigLoader = new Twig_Loader_Filesystem('../src/'.$appName.'/view');
        $this->appEnvironment = new Twig_Environment($twigLoader);
        
        //load application config file
        require_once '../src/'.$appName.'/config/config.php';
        
        //load helper functions
        $this->helper = new Helper;
        
        //load dispatcher
        $this->dispatcher = new Dispatcher($this);
    }
    
    public function getAppName()
    {
        return $this->appName;
    }

    public function getAppLoader()
    {
        return $this->appLoader;
    }

//    public function getEnvLoader()
//    {
//        return $this->envLoader;
//    }

    public function getDispatcher()
    {
        return $this->dispatcher;
    }
   
    public function getUrl()
    {
        return '/'.$this->getAppName();
    }
    
    public function getHelper()
    {
        return $this->helper;
    }
    
    public function getAppEnvironment()
    {
        return $this->appEnvironment;
    }
    
    public function render($view, $model)
    {
        print($this->getFrameworkEnvironment()->render($view, $model));
    }
}