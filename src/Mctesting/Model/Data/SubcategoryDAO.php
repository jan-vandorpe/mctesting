<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Category;
use Mctesting\Model\Entity\Subcategory;
use Mctesting\Model\Service\CategoryService;
use Mctesting\Exception\ApplicationException;

/* * **** Author: Bert Mortier ****** */

class SubcategoryDAO
{

    public static function selectById($subcatid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE subcatid = :subcatid limit 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatid' => $subcatid,)))
        {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record))
            {
                //create object(s) and return
                $category = \Mctesting\Model\Service\CategoryService::getById($record['catid']);
                //create  object
                $subcat = new Subcategory();
                $subcat->setId($record['subcatid']);
                $subcat->setSubcatname($record['subcatnaam']);
                $subcat->setActive($record['actief']);
                return $subcat;
            } else
            {
                throw new ApplicationException('Kon geen subcategorie ophalen, gelieve dit te controleren');
            }
        } else
        {
            throw new ApplicationException('Ophalen subcategorie statement kan niet worden uitgevoerd');
        }
    }

    public static function selectByCategoryId($catid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE catid = :catid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catid' => $catid)))
        {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset))
            {
                //create array
                $subcatarray = array();
                //create object and return
                $category = \Mctesting\Model\Service\CategoryService::getById($catid);
                //create subcategory object(s)
                foreach ($resultset as $record)
                {
                    $subcat = new Subcategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setSubcatname($record['subcatnaam']);
                    $subcat->setActive($record['actief']);

                    //     don't set because subcategories are put into category object
                    //         $subcat->setCategory($category);

                    array_push($subcatarray, $subcat);
                }
                return $subcatarray;
            } else
            {
                //create array
                $subcatarray = array();
                //create object
                $subcat = new Subcategory();
                $subcatname = "nog geen subcategorie aanwezig";
                $subcat->setSubcatname($subcatname);
                //push object to array
                array_push($subcatarray, $subcat);
                return $subcatarray;
            }
        } else
        {
            throw new ApplicationException('Ophalen subcategorieset statement kan niet worden uitgevoerd');
        }
    }

    public static function selectActiveByCategoryId($catid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE catid = :catid AND actief = 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catid' => $catid)))
        {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset))
            {
                //create array
                $subcatarray = array();
                //create object and return
                $category = \Mctesting\Model\Service\CategoryService::getById($catid);
                //create subcategory object(s)
                foreach ($resultset as $record)
                {
                    $subcat = new Subcategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setSubcatname($record['subcatnaam']);
                    $subcat->setActive($record['actief']);

                    //     don't set because subcategories are put into category object
                    //         $subcat->setCategory($category);

                    array_push($subcatarray, $subcat);
                }
                return $subcatarray;
            } else
            {
                //create array
                $subcatarray = array();
                //create object
                $subcat = new Subcategory();
                $subcatname = "nog geen subcategorie aanwezig";
                $subcat->setSubcatname($subcatname);
                //push object to array
                array_push($subcatarray, $subcat);
                return $subcatarray;
            }
        } else
        {
            throw new ApplicationException('Ophalen subcategorieset statement kan niet worden uitgevoerd');
        }
    }

    public static function selectAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie order by catid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute())
        {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset))
            {
                //create array
                $subcatarray = array();
                foreach ($resultset as $record)
                {
                    //create category object and return
                    $category = \Mctesting\Model\Service\CategoryService::getById($record['catid']);
                    //create subcategory object(s)
                    $subcat = new Subcategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setSubcategory($record['subcatnaam']);
                    $subcat->setActive($record['actief']);

                    array_push($subcatarray, $subcat);
                }
                return $subcatarray;
            } else
            {
                throw new ApplicationException('Kon subcategorieën niet ophalen, gelieve dit te controleren');
            }
        } else
        {
            throw new ApplicationException('Ophalen subcategorieën statement kan niet worden uitgevoerd');
        }
    }

    public static function selectAllActive()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie order by catid where actief = 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute())
        {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset))
            {
                //create array
                $subcatarray = array();
                foreach ($resultset as $record)
                {
                    //create category object and return
                    $category = \Mctesting\Model\Service\CategoryService::getById($record['catid']);
                    //create subcategory object(s)
                    $subcat = new Subcategory();
                    $subcat->setId($record['subcatid']);
                    $subcat->setSubcategory($record['subcatnaam']);
                    $subcat->setActive($record['actief']);

                    array_push($subcatarray, $subcat);
                }
                return $subcatarray;
            } else
            {
                throw new ApplicationException('Kon subcategorieën niet ophalen, gelieve dit te controleren');
            }
        } else
        {
            throw new ApplicationException('Ophalen subcategorieën statement kan niet worden uitgevoerd');
        }
    }

    public static function checkName($subcatname, $catid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM subcategorie WHERE subcatnaam = :subcatname AND catid = :catid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatname' => $subcatname, ':catid' => $catid,)))
        {
            //test if statement retrieved something
            $result = $stmt->fetchall();
            if (!empty($result))
            //if statement returned a value
            {
                return true;
            } else
            //if statement returns no value
            {
                return false;
            }
        } else
        {
            throw new ApplicationException('check voor naam subcategorie kan niet worden uitgevoerd');
        }
    }

    public static function insert($catid, $subcatname)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO subcategorie(catid, subcatnaam) values(:catid, :subcatnaam)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatnaam' => $subcatname, ':catid' => $catid,)))
        {
            
        } else
        {
            $error = $stmt->errorInfo();

            throw new ApplicationException('Kon geen subcategorie in de database invoeren, gelieve dit te controleren' . $error[2]);
        }
    }

    public static function activateById($subcatid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE subcategorie SET actief=1 WHERE subcatid = :subcatid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatid' => $subcatid)))
        {
            
        } else
        {
            throw new ApplicationException('Kon de subcategorie in de database niet op actief zetten, gelieve dit te controleren');
        }
    }

    public static function deactivateById($subcatid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE subcategorie SET actief=0 WHERE subcatid = :subcatid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':subcatid' => $subcatid)))
        {
            
        } else
        {
            throw new ApplicationException('Kon de subcategorie in de database niet passief zetten, gelieve dit te controleren');
        }
    }

}
