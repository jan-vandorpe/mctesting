<?php

namespace Mctesting\Model\Data;

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
            if (!empty($recordset)) {
                //fill array with filename strings and return
                $result = array();
                foreach ($recordset as $record) {
                    //create answer object
                    array_push($result, $record['filename']);
                }
                return $result;
            } else {
                throw new ApplicationException('Media selectByQuestion recordset is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'Media selectByQuestion statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
        }
    }
    
    public static function insert()
    {
        
    }
}
