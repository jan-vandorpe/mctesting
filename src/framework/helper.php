<?php

namespace Framework;

use Framework\Exception\SecurityException;
use Framework\Exception\FrameworkException;

/**
 * Description of helper
 * 
 * Application Helper class containing helper functions
 *
 * @author cyber02
 */
class Helper
{
    /**
     * Secure version of the standard session_start() function 
     */
    public function sec_session_start()
    {
        $session_name = 'sec_session_id'; //set a custom session name
        $secure = false; //set to true if using https
        $httponly = true; //stops javascript access to session id
        ini_set('session.use_only_cookies',1); //forces sessions to only use cookies
        $cookieParams = session_get_cookie_params(); //gets current cookies params
        session_set_cookie_params($cookieParams['lifetime'], $cookieParams['path'], $cookieParams['domain'], $secure, $httponly);
        session_name($session_name); //sets session name to custom name set above
        session_start(); //start php session
        session_regenerate_id();    
    }

    /**
     * Function that determines if the current user as access to the requested
     * controller.
     * Access to different sections of the application is solely determined by
     * which controller is requested. The controllers that allow for public
     * access should be listed in the $public_access array.
     * If a controller other than those is requested and the user isn't logged
     * in it will throw an AuthenticationException with code 1.
     * Code 1 AuthenticationExceptions caught in the dispatcher will result in
     * a redirect to the login page.
     * @throws AuthenticationException
     */
    public function check_access_control($requestedController)
    {
        //force lowercase for requestedController
        $requestedController = strtolower($requestedController);
        
        //access control array
        $access_control['anonymous'] = array('home',);
        $access_control['user'] = array();
        $access_control['admin'] = array();
        $access_control['superadmin'] = array();
        
        /*
         * Determine if requested controller is listed in access control
         */
        if (!$this->in_multiarray(strtolower($requestedController), $access_control)) {
            throw new FrameworkException('Requested controller '.$requestedController.' not listed in access control');
        }
        
        /*
         * Determine security level for current user
         */
//        $_SESSION['user'] = 'Thomas';
         if (isset($_SESSION['user'])) {
//            $clearance = 1;
//            $clearance = $user->getGroup->getClearance();
        } else {
            $clearance = 0;
        }
        
        //generate ACL based on security level
        $acl = $this->generateACL($access_control, $clearance);
        
        /*
         * If controller is listed but not in generated ACL then user does not have 
         * the required clearance leven, throw exception
         */
        if (!in_array($requestedController, $acl)) {
            throw new SecurityException('Access denied', 1);
        }
        
//        if (!in_array(strtolower($requestedController), $public_access)){
//            //test if SESSION var indicating login status is set
//            if (!isset($_SESSION['user'])) {
//                throw new SecurityException('Not logged in',1);
//            } 
//        }
    }
    
    /*
     * Variant of PHP in_array() function that works for multi dimensional arrays
     * source: http://stackoverflow.com/questions/4128323/in-array-and-multidimensional-array
     */
    public function in_multiarray($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_multiarray($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }
    
    public function generateACL($access_control, $clearance)
    {
        $acl = array();
        if ($clearance >= 0) {
            $acl = array_merge($acl, $access_control['anonymous']);
            if ($clearance >= 1) {
                $acl = array_merge($acl, $access_control['user']);
                if ($clearance >= 2) {
                    $acl = array_merge($acl, $access_control['admin']);
                    if ($clearance >= 3) {
                        $acl = array_merge($acl, $access_control['superadmin']);
                    }
                }
            }
        }
        
        return $acl;
    }
}
