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

}
