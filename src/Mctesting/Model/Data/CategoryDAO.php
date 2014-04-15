<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Category;
use Mctesting\Exception\ApplicationException;

/****** Author: Bert *******/

class CategoryDAO {

    public static function selectById($catid) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM categorie WHERE catid = :catid limit 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catid' => $catid))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                //create and return object

                $category = new Category();
                $category->setId($record['catid']);
                $category->setCatname($record['catnaam']);
                return $category;
            } else {
                throw new ApplicationException('Kon geen categorie ophalen, gelieve dit te controleren');
            }
        } else {
            throw new ApplicationException('Ophalen categorie statement kan niet worden uitgevoerd');
        }
    }

    public static function selectAll() {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM categorie';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute()) {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset)) {
                //create array
              $categories = array();
                //create category object(s)
                foreach ($resultset as $record) {
                    $category = new Category();
                    $category->setId($record['catid']);
                    $category->setCatname($record['catnaam']);
                    array_push($categories,$category);
                }
                return $categories;
            } else {
                throw new ApplicationException('Kon geen categorieset ophalen, gelieve dit te controleren');
            }
        } else {
            throw new ApplicationException('Ophalen categorieset statement kan niet worden uitgevoerd');
        }
    }
    
    public static function checkName($catname) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM categorie WHERE catnaam = :catname limit 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catname' => $catname))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (empty($record)) {
              
                return true;
            } else {
                throw new ApplicationException('Deze categorie bestaat al');
            }
        } else {
            throw new ApplicationException('Ophalen categorie statement kan niet worden uitgevoerd');
        }
    }

    public static function insert($catname) {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO categorie(catnaam) values(:catname)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catname' => $catname))) {
           
            } else {
                throw new ApplicationException('Kon geen categorie in de database invoeren, gelieve dit te controleren');
            }
         
    }    
    
    
    
    
    
}
