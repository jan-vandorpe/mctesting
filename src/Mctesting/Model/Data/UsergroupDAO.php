<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Usergroup;
use Mctesting\Exception\ApplicationException;

/**
 * Description of UsergroupDAO
 *
 * @author cyber01
 */
class UsergroupDAO
{
    public static function selectAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM usergroup';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
                //create object(s) and return
                $result = array();
                foreach ($recordset as $record) {
                    //create article object
                    $usergroup = new Usergroup();
                    $usergroup->setId($id) = $record['id'];
                    $usergroup->setName($name) = $record['name'];
                    array_push($result, $usergroup);
                }
                return $result;
            } else {
                throw new ApplicationException('usergroup selectAll recordset empty');
            }
        } else {
            throw new ApplicationException('usergroup selectAll statement could not be executed');
        }
    }
    
    public static function selectById($id)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM usergroup WHERE id = :id';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':id' => $id))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                //create article object
                $usergroup = new Usergroup();
                $usergroup->setId($record['id']);
                $usergroup->setName($record['name']);
                return $usergroup;
            } else {
                throw new ApplicationException('usergroup selectById record empty');
            }
        } else {
            throw new ApplicationException('usergroup selectById statement could not be executed');
        }
    }
}
