<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\BeheerderDAO;
use Mctesting\Model\Service\UserService;

class BeheerderService {

    public static function registerBeheerder($user) {  

        $hashedpassword = UserService::encryptPassword(BEH_PASS);
        $timestamp = date('Y-m-d G:i:s');
        
        return BeheerderDAO::insert($user, $hashedpassword, $timestamp);
        
    }
}
