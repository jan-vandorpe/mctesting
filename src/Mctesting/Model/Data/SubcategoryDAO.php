<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Subcategory;
use Mctesting\Model\Service\CategoryService;
use Mctesting\Exception\ApplicationException;


/****** Author: Bert *******/

class SubcategoryDAO {

    public static function selectById($catid,$subcatid) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE subcatid = :subcatid AND catid = :catid limit 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatid' => $subcatid, ':catid' => $catid))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create object(s) and return
                $category = \Mctesting\Model\Service\CategoryService::getById($record['catid']);
                //create  object
                $subcat = new Subcategory();
                $subcat->setId($record['subcatid']);
                $subcat->setSubcategory($record['subcatnaam']);
                $subcat->setCategory($category);
                return $subcat;
            } else {
                throw new ApplicationException('Kon geen subcategorie ophalen, gelieve dit te controleren');
            }
        } else {
            throw new ApplicationException('Ophalen subcategorie statement kan niet worden uitgevoerd');
        }
    }

    public static function selectByCategoryId($catid) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE catid = :catid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catid' => $catid))) {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset)) {
                //create array
                $subcatarray = array();
                //create object and return
                $category = \Mctesting\Model\Service\CategoryService::getById($catid);
                //create subcategory object(s)
                foreach ($resultset as $record) {
                    $subcat = new Subcategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setSubcategory($record['subcatnaam']);
                    $subcat->setCategory($category);
                    array_push($subcatarray, $subcat);
                }
                return $subcatarray;
            } else {
                throw new ApplicationException('Kon geen subcategorieset ophalen, gelieve dit te controleren');
            }
        } else {
            throw new ApplicationException('Ophalen subcategorieset statement kan niet worden uitgevoerd');
        }
    }

    public static function selectAll() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie order by catid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset)) {
                //create array
                $subcatarray = array();
                foreach ($resultset as $record) {
                    //create category object and return
                    $category = \Mctesting\Model\Service\CategoryService::getById($record['catid']);
                //create subcategory object(s)
                    $subcat = new Subcategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setSubcategory($record['subcatnaam']);
                    $subcat->setCategory($category);
                    array_push($subcatarray, $subcat);
                }
                return $subcatarray;
            } else {
                throw new ApplicationException('Kon subcategorieën niet ophalen, gelieve dit te controleren');
            }
        } else {
            throw new ApplicationException('Ophalen subcategorieën statement kan niet worden uitgevoerd');
        }
    }
        public static function createNewSubcategory($catid,$subcatid,$subcatnaam) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO subcategorie(catid,subcatid,subcatnaam) values(:catid,:subcatid,:subcatnaam)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catid' => $catid,':subcatid' => $subcatid,':subcatnaam' => $subcatnaam))) {
           
            } else {
                throw new ApplicationException('Kon geen subcategorie in de database invoeren, gelieve dit te controleren');
            }
         
    } 
    

}
