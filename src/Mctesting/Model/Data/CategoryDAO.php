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
            throw new ApplicationException('De categorie kon niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function selectByTestId($testid){
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT DISTINCT cat.catid FROM categorie AS cat INNER JOIN (subcategorie AS sub INNER JOIN testsubcat AS testsub ON sub.subcatid = testsub.subcatid )ON cat.catid = sub.catid WHERE testsub.testid = :testid';
        $stmt = $db->prepare($sql);
        //test if statement can be executed
        if ($stmt->execute(array(':testid' => $testid,))) {
            //test if statement retrieved something
            $record = $stmt->fetch();
            if (!empty($record)) {
                return $record['catid'];
            } else {
                throw new ApplicationException('Er werd geen categorieId gevonden, gelieve dit te controleren');
            }
        } else {
            $error = $stmt->errorInfo();            
            throw new ApplicationException('De categorieId van de test ('.$testid.') konden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }
    
    public static function selectAll()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM categorie ORDER BY catnaam';
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
                return false;
                //throw new ApplicationException('Er zijn geen categorieën gevonden');
            }
        } else
        {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De categorieën konden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }

    public static function selectAllExceptEmpty()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT categorie.catid as catid, categorie.catnaam as catnaam, categorie.actief as actief FROM categorie inner join (subcategorie inner join vraag on subcategorie.subcatid = vraag.subcatid) on subcategorie.catid = categorie.catid WHERE subcategorie.actief = 1 and vraag.actief = 1 GROUP BY catid ORDER BY catnaam';
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
                throw new ApplicationException('Er zijn geen categorieën gevonden, gelieve nieuwe categorieën aan te maken.');
            }
        } else
        {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De categorieën konden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
        }
    }

    public static function selectAllActive()
    {
        //create db connection
        $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
        //prepare sql statement
        $sql = 'SELECT * FROM categorie where actief = 1 ORDER BY catnaam';
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
            throw new ApplicationException('De categorieën konden niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
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
                throw new ApplicationException('De categorie ('.$catname.') bestaat al, gelieve de categorie een andere naam te geven');
            }
        } else
        {
            $error = $stmt->errorInfo();
            throw new ApplicationException('De categorie ('.$catname.') kon niet worden opgehaald, gelieve dit te controleren:<br>'.$error[2]);
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
            throw new ApplicationException('Kon geen categorie in de database invoeren, gelieve dit te controleren:<br>'.$error[2]);
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
            throw new ApplicationException('Kon de categorie in de database niet op actief zetten, gelieve dit te controleren:<br>'.$error[2]);
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
            throw new ApplicationException('Kon de categorie in de database niet op passief zetten, gelieve dit te controleren:<br>'.$error[2]);
        }
    }

}
