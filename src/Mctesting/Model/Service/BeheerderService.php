<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\BeheerderDAO;
use Mctesting\Model\Service\UserService;

class BeheerderService {
    
    public function getAllBeheerders(){
        return BeheerderDAO::selectAllBeheerders();
    }
    
    public static function registerBeheerder($user) { 
        $hashedpassword = UserService::encryptPassword(BEH_PASS);
        $timestamp = date('Y-m-d G:i:s');        
        return BeheerderDAO::insert($user, $hashedpassword, $timestamp);        
    }
    
    public static function updateBeheerder($user) {             
        return BeheerderDAO::update($user);        
    }
    
    public function resetPassword($rrnr){
        $hashedpassword = UserService::encryptPassword(BEH_PASS);
        return BeheerderDAO::changePassword($rrnr, $hashedpassword);
    }
    
    public function changePassword($rrnr, $password){
        $hashedpassword = UserService::encryptPassword($password);
        return BeheerderDAO::changePassword($rrnr, $hashedpassword);
    }
}