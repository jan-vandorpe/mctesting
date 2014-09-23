<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Category;
use Mctesting\Exception\ApplicationException;

/* * **** Author: Bert Mortier ****** */

class CategoryDAO
{

    public static function selectById($catid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM categorie WHERE catid = :catid limit 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catid' => $catid)))
        {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record))
            {
                //create and return object
                $category = new Category();
                $category->setId($record['catid']);
                $category->setCatname($record['catnaam']);
                $category->setActive($record['actief']);
                return $category;
            } else
            {
                throw new ApplicationException('Kon geen categorie ophalen, gelieve dit te controleren');
            }
        } else
        {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Ophalen categorie statement kan niet worden uitgevoerd: '.$error[2]);
        }
    }

    public static function selectAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM categorie';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute())
        {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset))
            {
                //create array
                $categories = array();
                //create category object(s)
                foreach ($resultset as $record)
                {
                    $category = new Category();
                    $category->setId($record['catid']);
                    $category->setCatname($record['catnaam']);
                    $category->setActive($record['actief']);
                    array_push($categories, $category);
                }
                return $categories;
            } else
            {
                throw new ApplicationException('Kon geen categorieset ophalen, gelieve dit te controleren');
            }
        } else
        {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Ophalen categorieset statement kan niet worden uitgevoerd: '.$error[2]);
        }
    }

    public static function selectAllExceptEmpty()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT categorie.catid as catid, categorie.catnaam as catnaam, categorie.actief as actief FROM categorie inner join subcategorie on subcategorie.catid = categorie.catid GROUP BY catid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute())
        {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset))
            {
                //create array
                $categories = array();
                //create category object(s)
                foreach ($resultset as $record)
                {
                    $category = new Category();
                    $category->setId($record['catid']);
                    $category->setCatname($record['catnaam']);
                    $category->setActive($record['actief']);
                    array_push($categories, $category);
                }
                return $categories;
            } else
            {
                throw new ApplicationException('Kon geen categorieset ophalen, gelieve dit te controleren');
            }
        } else
        {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Ophalen categorieset statement kan niet worden uitgevoerd: '.$error[2]);
        }
    }

    public static function selectAllActive()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM categorie where actief = 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute())
        {
            //test if statement retrieved something
            $resultset = $stmt->fetchall();
            if (!empty($resultset))
            {
                //create array
                $categories = array();
                //create category object(s)
                foreach ($resultset as $record)
                {
                    $category = new Category();
                    $category->setId($record['catid']);
                    $category->setCatname($record['catnaam']);
                    $category->setActive($record['actief']);
                    array_push($categories, $category);
                }
                return $categories;
            } else
            {
                throw new ApplicationException('Kon geen categorieset ophalen, gelieve dit te controleren');
            }
        } else
        {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Ophalen categorieset statement kan niet worden uitgevoerd: '.$error[2]);
        }
    }

    public static function checkName($catname)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM categorie WHERE catnaam = :catname limit 1';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catname' => $catname)))
        {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (empty($record))
            {
                return true;
            } else
            {
                throw new ApplicationException('Deze categorie bestaat al');
            }
        } else
        {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Ophalen categorie statement kan niet worden uitgevoerd: '.$error[2]);
        }
    }

    public static function insert($catname)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'INSERT INTO categorie(catnaam) values(:catname)';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catname' => $catname)))
        {
            
        } else
        {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon geen categorie in de database invoeren, gelieve dit te controleren: '.$error[2]);
        }
    }

    public static function activateById($catid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE categorie SET actief=1 WHERE catid = :catid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catid' => $catid)))
        {
            
        } else
        {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon de categorie in de database niet op actief zetten, gelieve dit te controleren: '.$error[2]);
        }
    }

    public static function deactivateById($catid)
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'UPDATE categorie SET actief=0 WHERE catid = :catid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':catid' => $catid)))
        {
            
        } else
        {
            $error = $stmt->errorInfo();
            throw new ApplicationException('Kon de categorie in de database niet op passief zetten, gelieve dit te controleren: '.$error[2]);
        }
    }

}
