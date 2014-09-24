<?php

namespace Mctesting\Model\Data;

use Mctesting\Exception\ApplicationException;

/**
 * Description of MediaDAO
 *
 * @author cyber01
 */
class MediaDAO
{
    public static function selectByQuestion($questionId)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM media WHERE vraagid = :vraagid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':vraagid' => $questionId,))) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            $result = array();
            if (!empty($recordset)) {
                //fill array with filename strings and return
                
                foreach ($recordset as $record) {
                    //create answer object
                    array_push($result, $record['filename']);
                }
                
//            } else {
//                throw new ApplicationException('Media selectByQuestion recordset is leeg');
            }
            return $result;
        } else {
            $error = $stmt->errorInfo();            
            throw new ApplicationException('De media voor de vraag ('.$questionId.') kon niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function insert($questionId, $mediaId, $filename)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO media';
        $sql .= ' (vraagid, mediaid, filename)';
        $sql .= ' VALUES (:vraagid, :mediaid, :filename)';
        $stmt = $db->prepare($sql);
        
        //test if statement can be executed
        if ($stmt->execute(array(':vraagid' => $questionId,
                                ':mediaid' => $mediaId,
                                ':filename' => $filename,
                                ))) {
        } else {
            $error = $stmt->errorInfo();            
            throw new ApplicationException('Kon geen media in de database invoeren, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
}
