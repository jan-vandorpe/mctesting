<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Code;
use Mctesting\Exception\ApplicationException;

class UploadDAO
{
    
    public static function selectAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM bramupload';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create usergroup object
                    $user = new Code();
                    $user->setNummer($record['nummer']);
                    $user->setCode($record['code']);                    
                    array_push($result, $user);
                }
                return $result;
            } else {
                throw new ApplicationException('users selectAll recordset is leeg');
            }
        } else {
            throw new ApplicationException('users selectAll statement kon niet worden uitgevoerd');
        }
    }
       
    
    
    
    public static function insert($codeTeUploaden)
    {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `bramupload`(`code`) VALUES (:code)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':code' => $codeTeUploaden ))) {            
            //test if statement succes
            return true;
        } else {            
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon deze code niet toevoegen: '.$error[2]);
            //header("location: /mctesting/agga/dagga");
        }
    }
    
    
    
    
    
    
    
    
}
