<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Entity\User;
use Mctesting\Model\Data\UserDAO;

/**
 * Description of UserService
 *
 * @author Thomas Deserranno
 */
class UserService {

    public static function serializeToSession($user) {
        $_SESSION['user'] = serialize($user);
    }

    public static function unserializeFromSession() {
        $user = unserialize($_SESSION['user']);

        return $user;
    }

    public static function getUser($id) {
        if (isValidEmail($id)) {
            selectByEmail($id);
            return $user;
        } else {
            if (isValidRRNr($id)) {
                selectByRRNr($id);
                return $user;
            }
        }
    }

    public function isValidEmailFormat($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
    }

    public function isValidRRNRFormat($rijksregisterNr) {
        //cleanup
        $rijksregisterNr = preg_replace('/[^0-9]/', "", $rijksregisterNr);

        if (preg_match('/^\d{11}$/', $rijksregisterNr)) {
            $result = true;
            return $result;
        } else {
            $result = false;
            return $result;
        }
        return $result;
    }

}
