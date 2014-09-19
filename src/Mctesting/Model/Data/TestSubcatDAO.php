<?php

namespace Mctesting\Model\Data;

use Mctesting\Exception\ApplicationException;

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
            throw new ApplicationException('Kon deze testsubcat niet toevoegen: ' . $error[2]);
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
                throw new ApplicationException('TestsubcatDAO selectByTestANDSubcategory recordset is leeg');
            }
        } else {
            $error = $stmt->errorInfo();
            $errormsg = 'TestsubcatDAO selectByTestANDSubcategory statement kan niet worden uitgevoerd'
                    . '<br>'
                    . '<br>'
                    . $error[2];
            throw new ApplicationException($errormsg);
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
            throw new ApplicationException('Kon de scores voor de subcategorieën niet toevoegen: ' . $error[2]);
        }
    }
}
