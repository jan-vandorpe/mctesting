<?php

namespace Framework;
use Framework\Exception\SecurityException;
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
    public function check_access_allowed($request)
    {
        //array containing first part of the names of controller that are accessible to
        //public users
        $public_access = array('home');
        //test if requested controller needs login
        if (!in_array(strtolower($request), $public_access)){
            //test if SESSION var indicating login status is set
            if (!isset($_SESSION['user'])) {
                throw new SecurityException('Not logged in',1);
            } 
        }
    }
}
