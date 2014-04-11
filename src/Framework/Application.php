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
class Application extends AbstractFramework
{
    protected $appName;
    protected $appLoader;
    protected $appEnvironment;
    protected $dispatcher;
    protected $user;
            
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
        require_once '../src/'.$appName.'/Config/Config.php';

        //load dispatcher
        $this->dispatcher = new Dispatcher($this);
        
        //initialize user
        $user = null;
        if (isset($_SESSION['user'])) {
            $user = UserService::unserializeFromSession();
        } 
        $this->user = $user;
        
    }
    
    public function getAppName()
    {
        return $this->appName;
    }

    public function getAppLoader()
    {
        return $this->appLoader;
    }

    public function getDispatcher()
    {
        return $this->dispatcher;
    }
   
    public function getUrl()
    {
        return '/'.$this->getAppName();
    }
    
    public function getAppEnvironment()
    {
        return $this->appEnvironment;
    }
    
    public function render($view, $model)
    {
        print($this->getFrameworkEnvironment()->render($view, $model));
    }
    
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }
}
