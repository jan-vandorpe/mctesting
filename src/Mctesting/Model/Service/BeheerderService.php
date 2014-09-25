<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Entity\User;
use Mctesting\Model\Data\UserDAO;
use Mctesting\Model\Service\UserService;

class BeheerderService {

    public static function registerBeheerder($user) {  

        $hashedpassword = UserService::encryptPassword($password);
        $success = UserDAO::registerNewUser($username, $hashedpassword, $address, $postcode, $email, $fullname);
        if ($success === true) {
            $newuser = UserDAO::getByName($username);
            return $newuser;
        }
    }

}
