<?php
namespace Framework;

use Doctrine\Common\ClassLoader;
use Twig_Autoloader;
use Twig_Loader_Filesystem;
use Twig_Environment;

/**
 * Description of AbstractFramework
 * Instanciates a Doctrine classloader for the Library, needed to load
 * the framework classes
 *
 * @author cyber02
 */
abstract class AbstractFramework
{
    private $frameworkLoader;
    private $frameworkEnvironment;
    
    function __construct()
    {
        //initialize Doctrine classloader for framework
        require_once '../vendor/Doctrine/Common/ClassLoader.php';
        $this->frameworkLoader = new ClassLoader('Framework', '../src');
        $this->frameworkLoader->register();
        
        //Initialize Twig environment for framework
        require_once '../vendor/Twig/Autoloader.php';
        Twig_Autoloader::register();
        $twigLoader = new Twig_Loader_Filesystem('../src/framework/view');
        $this->frameworkEnvironment = new Twig_Environment($twigLoader);
    }
    
    public function getFrameworkEnvironment()
    {
        return $this->frameworkEnvironment;
    }
}
