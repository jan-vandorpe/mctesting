<?php

namespace Framework;

use Framework\Exception\SecurityException;
use Framework\Exception\FrameworkException;
use Mctesting\Model\Service\UserService;

/**
 * Description of helper
 * 
 * Helper functions for application
 * 
 * @author Thomas Deserranno
 */

/**
 * Secure version of the standard session_start() function 
 */
function sec_session_start()
{
    $session_name = 'sec_session_id'; //set a custom session name
    $secure = false; //set to true if using https
    $httponly = true; //stops javascript access to session id
    ini_set('session.use_only_cookies', 1); //forces sessions to only use cookies
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
 * which controller is requested.
 * If a controller is requested that isn't listed in the access control array
 * a framework exception will be thrown with an appropriate message .
 * If a listed controller is requested but the user doesn't have the appropriate
 * clearance then a security exception will be thrown informing the user that
 * access was denied.
 */
function check_access_control($requestedController)
{
    //force lowercase for requestedController
    $requestedController = strtolower($requestedController);

    //access control array
    $access_control['anonymous'] = array('home', 'login',);
    $access_control['user'] = array('test', 'acltest', 'choosesession');
    $access_control['admin'] = array('question', 'scores', 'tests', 'testadmin', 'usermanagement', 'upload', 'category', 'beheerder');
    $access_control['superadmin'] = array('');

    //Determine if requested controller is listed in access control array
    if (!in_multiarray(strtolower($requestedController), $access_control)) {
        throw new FrameworkException('Requested controller ' . $requestedController . ' not listed in access control');
    }

    /*
     * Determine security clearance level for current user using the primary key
     * of usercategory. This key represents the user security clearance level
     */
    if (isset($_SESSION['user'])) {
        $user = UserService::unserializeFromSession();
        $clearance = $user->getGroup()->getId();
    } else {
        $clearance = 0;
    }

    //generate ACL based on clearance
    $acl = generateACL($access_control, $clearance);

    /*
     * If controller is listed but not in generated ACL then user does not have 
     * the required clearance leven, throw exception
     */
    if (!in_array($requestedController, $acl)) {
        throw new SecurityException('Access denied', 1);
    }
}

/*
 * Variant of PHP in_array() function that works for multi dimensional arrays
 * source: http://stackoverflow.com/questions/4128323/in-array-and-multidimensional-array
 */

function in_multiarray($needle, $haystack, $strict = false)
{
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_multiarray($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}

/*
 * Function that merges the different access control subarrays into 1 array
 * based on user catergory
 */

function generateACL($access_control, $clearance)
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
