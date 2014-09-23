<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Usergroup;
use Mctesting\Exception\ApplicationException;

/**
 * Description of UsergroupDAO
 *
 * @author Thomas Deserranno
 */
class UsergroupDAO
{
    public static function selectAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikerscategorie';
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
                    $usergroup = new Usergroup();
                    $usergroup->setId($record['typeid']);
                    $usergroup->setName($record['typenaam']);
                    array_push($result, $usergroup);
                }
                return $result;
            } else {
                throw new ApplicationException('Er zijn geen gebruikercategorieën gevonden');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De gebruikercategorieën konden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function selectById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM gebruikerscategorie WHERE typeid = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                //create usergroup object
                $usergroup = new Usergroup();
                $usergroup->setId($record['typeid']);
                $usergroup->setName($record['typenaam']);
                return $usergroup;
            } else {
                throw new ApplicationException('Er werd geen gebruikercategorie ('.$id.') gevonden, gelieve dit te controleren');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De gebruikercategorie ('.$id.') kon niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
}
