<?php

namespace Mctesting\Model\Data;

use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Entity\UserSessionSubCategory;

/**
 * Description of TestSessionDAO
 *
 * @author Bram
 */
class TestSubcatDAO {

    public static function insert($testid, $subcat) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO `testsubcat`(`testid`, `subcatid`, `aantal`, `totgewicht`, `tebehalenscore` ) 
                                    VALUES (:testid,:subcatid,:subcount,:subweight,:passpercentage)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':testid' => $testid, ':subcatid' => $subcat["id"], ':subcount' => $subcat["count"], ':subweight' => $subcat["weight"], ':passpercentage' => $subcat["passpercentage"]))) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon geen testsubcat in de database invoeren, gelieve dit te controleren:<br>'.$error[2]);
        }
    }

    /**Function returns associative array containing data from DB for given test
     * and subcategory
     * 
     * @param type $testId
     * @param type $subcatId
     * @return array
     * @throws ApplicationException
     */
    public static function selectByTestANDSubcategory($testId, $subcatId)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM testsubcat WHERE testid = :testid AND subcatid = :subcatid';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':testid', $testId);
        $stmt->bindParam(':subcatid', $subcatId);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
//                $result = array(
//                    'questioncount' => 4,
//                    'totalweight' => 18,
//                    'passpercentage' => 50,
//                    );
                
                foreach ($recordset as $record) {
                    //
                    $result = array(
                        'questioncount' => $record['aantal'],
                        'totalweight' => $record['totgewicht'],
                        'passpercentage' => $record['tebehalenscore'],
                    );
                }
                return $result;
            } else {
                throw new ApplicationException('Er werd geen testsubcat gevonden voor deze combinatie van test ('.$testId.') en subcat ('.$subcatId.')');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('testsubcat konden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function insertSubCatResults($testId,$subCatId,$testSessionId,$userId,$score,$percentage){
      $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
      $sql = 'INSERT INTO `sessiegebruikercategoriepercentages`'
              . '(`sessieid`, `rijksregisternr`, `testid`, `subcatid`, `score`, `percentage`) '
              . 'VALUES (:sessieid,:rkknr,:testid,:subcatid,:score,:percentage)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':sessieid', $testSessionId);
        $stmt->bindParam(':rkknr', $userId);
        $stmt->bindParam(':testid', $testId);
        $stmt->bindParam(':subcatid', $subCatId);
        $stmt->bindParam(':score', $score);
        $stmt->bindParam(':percentage', $percentage);
        //test if statement can be executed
        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            //throw new ApplicationException($error[2]);
            throw new ApplicationException('Kon de scores voor de subcategorieën niet toevoegen, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function delete($testId) {
        //create db connection        
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement

        $sql = 'DELETE FROM `testsubcat` WHERE `testid` = :testid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':testid' => $testId ))) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon subcategorieen in de database niet verwijderen, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function selectSubCatsByTest($testId)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM testsubcat WHERE testid = :testid';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':testid', $testId);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $recordset = $stmt->fetchAll();
            if (!empty($recordset)) {
//                $result = array(
//                    'questioncount' => 4,
//                    'totalweight' => 18,
//                    'passpercentage' => 50,
//                    );
                $result = array();
                foreach ($recordset as $record) {
                    //
                    $subcat = new UserSessionSubCategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setMaxScore($record['totgewicht']);
                    $subcat->setPassPercentage($record['tebehalenscore']);
                    $subcat->setQuestionCount($record['aantal']);
                    array_push($result, $subcat);
                }
                return $result;
            } else {
                throw new ApplicationException('Er werd geen testsubcat gevonden voor deze combinatie van test ('.$testId.') en subcat ('.$subcatId.')');
            }
        } else {
            $error = $stmt->errorInfo();
            throw new ApplicationException('testsubcat konden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
}
