<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Entity\User;
use Mctesting\Model\Data\UploadDAO;

/**
 * Description of UserService
 *
 * @author Thomas Deserranno
 */
class UploadService
{
    public static function serializeToSession($user)
    {
        $_SESSION['user'] = serialize($user);
    }
    
    public static function unserializeFromSession()
    {
        $user = unserialize($_SESSION['user']);
        
        return $user;
    }
    
    public static function upload($codeTeUploaden)
    {
        if(UploadDAO::insert($codeTeUploaden)){
                return true;
            }else{
                //exception
                return false;
            }
    }
    
    public static function showUploads()
    {
        return UploadDAO::selectAll();
    }
    
    
    
//    
//    public function createTestUser($firstName, $lastName, $RRNr) {
//        //cleanup
//        $userGroup = 1;
//            if(UserDAO::insert($firstName, $lastName, $RRNr, $userGroup)){
//                return true;
//            }else{
//                //exception
//                return false;
//            }
////        }
//    }
    
    
    
    
    
}