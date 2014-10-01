<?php

namespace Mctesting\Model\Data;

use Mctesting\Model\Entity\Question;
use Mctesting\Model\Service\AnswerService;
use Mctesting\Model\Service\SubcategoryService;
use Mctesting\Model\Service\MediaService;
use Mctesting\Exception\ApplicationException;

/**
 * Description of QuestionDAO
 * 
 * Data Access Object for Question Entity/Table
 *
 * @author cyber01
 */
class QuestionDAO {
  /*
   * Returns a single question object with given id.
   */

  public static function selectById($id) {
    //create db connection
    $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
    //prepare sql statement
    $sql = 'SELECT * FROM vraag WHERE vraagid = :vraagid';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':vraagid', $id);
    //test if statement can be executed
    if ($stmt->execute()) {
      //test if statement retrieved something
      $record = $stmt->fetch();
      if (!empty($record)) {
        //create object(s) and return
        //retrieve subcategory object
        $subcategory = SubcategoryService::getById($record['subcatid']);
        //retrieve answers for question
        $answers = AnswerService::getByQuestion($record['vraagid']);
        //retrieve media filename array for question
        $media = MediaService::getByQuestion($record['vraagid']);
        //create question object
        $question = new Question();
        $question->setId($record['vraagid']);
        $question->setText($record['vraagtekst']);
        $question->setWeight($record['gewicht']);
        $question->setSubcategory($subcategory);
        $question->setCorrectAnswer($record['correctantwoord']);
        $question->setAnswers($answers);
        $question->setMedia($media);
        $question->setActive((boolean) $record['actief']);
        return $question;
      } else {
        throw new ApplicationException('Er werd geen vraag (' . $id . ') gevonden, gelieve dit te controleren');
      }
    } else {
      $error = $stmt->errorInfo();
      throw new ApplicationException('De vraag (' . $id . ') kon niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
    }
  }

  public static function selectByTest($testid) {
      //create db connection
    $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
    //prepare sql statement
    $sql = 'SELECT vraagid FROM testvragen WHERE testid = :testid ';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':testid', $testid);
    //test if statement can be executed
    if ($stmt->execute()) {
      //test if statement retrieved something
      $recordset = $stmt->fetchAll();
      if (!empty($recordset)) {        
        $result = array();
        foreach ($recordset as $record) {       
          array_push($result, $record['vraagid']);
        }
        return $result;
      } else {
        throw new ApplicationException('De gekozen test (' . $testid . ') bevat geen vragen');
      }
    } else {
      $error = $stmt->errorInfo();
      throw new ApplicationException('De vragen van de gekozen test (' . $testid . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
    }
  }
  
  /*
   * Returns an array of question objects based on given categoryid.
   */

  public static function selectByCategory($categoryId) {
    //create db connection
    $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
    //prepare sql statement
    $sql = 'SELECT * FROM vraag WHERE subcatid IN (SELECT subcatid FROM subcategorie WHERE catid = :catid)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':catid', $categoryId);
    //test if statement can be executed
    if ($stmt->execute()) {
      //test if statement retrieved something
      $recordset = $stmt->fetchAll();
      if (!empty($recordset)) {
        $result = array();
        foreach ($recordset as $record) {
          //create object(s) and return
          //retrieve subcategory object
          $subcategory = SubcategoryService::getById($record['subcatid']);
          //retrieve answers for question
          $answers = AnswerService::getByQuestion($record['vraagid']);
          //retrieve media filename array for question
          $media = MediaService::getByQuestion($record['vraagid']);
          //create question object
          $question = new Question();
          $question->setId($record['vraagid']);
          $question->setText($record['vraagtekst']);
          $question->setWeight($record['gewicht']);
          $question->setSubcategory($subcategory);
          $question->setCorrectAnswer($record['correctantwoord']);
          $question->setAnswers($answers);
          $question->setMedia($media);
          $question->setActive((boolean) $record['actief']);
          array_push($result, $question);
        }
        return $result;
      } else {
        throw new ApplicationException('De gekozen categorie (' . $categoryId . ') bevat geen vragen');
      }
    } else {
      $error = $stmt->errorInfo();
      throw new ApplicationException('De vragen van de gekozen categorie (' . $categoryId . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
    }
  }

  public static function selectBySubCategory($subCatId) {
    //create db connection
    $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
    //prepare sql statement
    $sql = 'SELECT * FROM vraag WHERE subcatid = :subCatId';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':subCatId', $subCatId);
    //test if statement can be executed
    if ($stmt->execute()) {
      //test if statement retrieved something
      $recordset = $stmt->fetchAll();
      if (!empty($recordset)) {
        $result = array();
        foreach ($recordset as $record) {
          //create object(s) and return
          //retrieve subcategory object
          //$subcategory = SubcategoryService::getById($record['subcatid']);
          //retrieve answers for question
          $answers = AnswerService::getByQuestion($record['vraagid']);
          //retrieve media filename array for question
          $media = MediaService::getByQuestion($record['vraagid']);
          //create question object
          $question = new Question();
          $question->setId($record['vraagid']);
          $question->setText($record['vraagtekst']);
          $question->setWeight($record['gewicht']);
          //$question->setSubcategory($subcategory);
          $question->setCorrectAnswer($record['correctantwoord']);
          $question->setAnswers($answers);
          $question->setMedia($media);
          $question->setActive((boolean) $record['actief']);
          array_push($result, $question);
        }
        return $result;
      } else {
        return false;
      }
    } else {
      $error = $stmt->errorInfo();
      throw new ApplicationException('De vragen van de gekozen subcategorie (' . $subCatId . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
    }
  }

  /*
   * Returns an array of ACTIVE question objects based on given categoryid.
   */

  public static function selectActiveByCategory($categoryId) {
    //create db connection
    $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
    //prepare sql statement
    $sql = 'SELECT * FROM vraag WHERE actief = :actief AND subcatid IN (SELECT subcatid FROM subcategorie WHERE catid = :catid)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':catid', $categoryId);
    $active = true;
    $stmt->bindParam(':actief', $active);
    //test if statement can be executed
    if ($stmt->execute()) {
      //test if statement retrieved something
      $recordset = $stmt->fetchAll();
      if (!empty($recordset)) {
        $result = array();
        foreach ($recordset as $record) {
          //create object(s) and return
          //retrieve subcategory object
          $subcategory = SubcategoryService::getById($record['subcatid']);
          //retrieve answers for question
          $answers = AnswerService::getByQuestion($record['vraagid']);
          //retrieve media filename array for question
          $media = MediaService::getByQuestion($record['vraagid']);
          //create question object
          $question = new Question();
          $question->setId($record['vraagid']);
          $question->setText($record['vraagtekst']);
          $question->setWeight($record['gewicht']);
          $question->setSubcategory($subcategory);
          $question->setCorrectAnswer($record['correctantwoord']);
          $question->setAnswers($answers);
          $question->setMedia($media);
          $question->setActive((boolean) $record['actief']);
          array_push($result, $question);
        }
        return $result;
      } else {
        throw new ApplicationException('Er zijn geen actieve vragen voor de categorie (' . $categoryId . ') gevonden');
      }
    } else {
      $error = $stmt->errorInfo();
      throw new ApplicationException('De actieve vragen voor de categorie (' . $categoryId . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
    }
  }

  /*
   * Returns an array of ACTIVE question objects based on given testid.
   */

  public static function selectActiveByTest($testId) {
    //create db connection
    $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
    //prepare sql statement
    $sql = 'SELECT * FROM vraag WHERE actief = :actief AND vraagid IN (SELECT vraagid FROM testvragen WHERE testid = :testid)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':testid', $testId);
    $active = true;
    $stmt->bindParam(':actief', $active);
    //test if statement can be executed
    if ($stmt->execute()) {
      //test if statement retrieved something
      $recordset = $stmt->fetchAll();
      if (!empty($recordset)) {
        $result = array();
        foreach ($recordset as $record) {
          //create object(s) and return
          //retrieve subcategory object
          $subcategory = SubcategoryService::getById($record['subcatid']);
          //retrieve answers for question
          $answers = AnswerService::getByQuestion($record['vraagid']);
          //retrieve media filename array for question
          $media = MediaService::getByQuestion($record['vraagid']);
          //create question object
          $question = new Question();
          $question->setId($record['vraagid']);
          $question->setText($record['vraagtekst']);
          $question->setWeight($record['gewicht']);
          $question->setSubcategory($subcategory);
          $question->setCorrectAnswer($record['correctantwoord']);
          $question->setAnswers($answers);
          $question->setMedia($media);
          $question->setActive((boolean) $record['actief']);
          array_push($result, $question);
        }
        return $result;
      } else {
        throw new ApplicationException('Er zijn geen actieve vragen voor de test (' . $testId . ') gevonden');
      }
    } else {
      $error = $stmt->errorInfo();
      throw new ApplicationException('De actieve vragen voor de test (' . $testId . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
    }
  }

  /*
   * Inserts a new question in the database.
   */

  public static function insert($questionText, $subcatId, $weight, $correctAnswerId, $answersArray, $questionMediaFileNames) {
    //create db connection
    $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
    //prepare sql statement
    $sql = 'INSERT INTO vraag';
    $sql .= ' (subcatid, vraagtekst, gewicht, correctantwoord)';
    $sql .= ' VALUES (:subcatid, :vraagtekst, :gewicht, :correctantwoord)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':subcatid', $subcatId);
    $stmt->bindParam(':vraagtekst', $questionText);
    $stmt->bindParam(':gewicht', $weight);
    $stmt->bindParam(':correctantwoord', $correctAnswerId);
    //test if statement can be executed
    if ($stmt->execute()) {
      $questionId = $db->lastInsertId();
      AnswerService::create($questionId, $answersArray);
      MediaService::create($questionId, $questionMediaFileNames);
    } else {
      $error = $stmt->errorInfo();
      throw new ApplicationException('Kon geen vraag in de database invoeren, gelieve dit te controleren:<br>' . $error[2]);
    }
  }

  public static function updateQuestion($question) {
    //create db connection
    $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
    //prepare sql statement
    $sql = "UPDATE `vraag` SET `subcatid`=:subcatid,`vraagtekst`=:vraagtekst,`gewicht`=:gewicht,`correctantwoord`=:correctant "
            . "WHERE vraagid=:vraagid";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':subcatid', $question->getSubCategory());
    $stmt->bindParam(':vraagtekst', $question->getText());
    $stmt->bindParam(':gewicht', $question->getWeight());
    $stmt->bindParam(':correctant', $question->getCorrectAnswer());
    $stmt->bindParam(':vraagid', $question->getId());
    //test if statement can be executed
    if ($stmt->execute()) {
      AnswerService::updateAnswer($question->getId(), $question->getAnswers());
      MediaService::updateQuestionMedia($question->getId(), $question->getMedia());
    } else {
      $error = $stmt->errorInfo();
      throw new ApplicationException('Kon geen vraag in de database updaten, gelieve dit te controleren:<br>' . $error[2]);
    }
  }
  
  public static function selectQuestionsNotInTestsBySubCategory($subCategoryId){
    //create db connection
    $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
    //prepare sql statement
    $sql = 'SELECT *,subcategorie.actief AS subcatactive,vraag.actief AS qactive FROM vraag, subcategorie WHERE subcategorie.subcatid = vraag.subcatid AND vraag.subcatid = :subCatId AND vraagid NOT IN (select vraagid from testvragen where 1)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':subCatId', $subCategoryId);
    //test if statement can be executed
    if ($stmt->execute()) {
      //test if statement retrieved something
      $recordset = $stmt->fetchAll();
      if (!empty($recordset)) {
        $result = array();
        foreach ($recordset as $record) {
          //create object(s) and return
          $subcategory = new \Mctesting\Model\Entity\Subcategory();
          $subcategory->setId($subCategoryId);
          $subcategory->setSubcatname($record['subcatnaam']);
          $subcategory->setActive((boolean)$record['subcatactive']);
          //retrieve answers for question
          $answers = AnswerService::getByQuestion($record['vraagid']);
          //retrieve media filename array for question
          $media = MediaService::getByQuestion($record['vraagid']);
          //create question object
          $question = new Question();
          $question->setId($record['vraagid']);
          $question->setText($record['vraagtekst']);
          $question->setWeight($record['gewicht']);
          $question->setSubcategory($subcategory);
          $question->setCorrectAnswer($record['correctantwoord']);
          $question->setAnswers($answers);
          $question->setMedia($media);
          $question->setActive((boolean) $record['qactive']);
          array_push($result, $question);
        }
        return $result;
      } else {
        return false;
      }
    } else {
      $error = $stmt->errorInfo();
      throw new ApplicationException('De vragen van de gekozen subcategorie (' . $subCatId . ') konden niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
    }
  }
  
  //for questions not in test
  public static function selectByIdQNIT($id) {
    //create db connection
    $db = new \PDO(DB_DSN, DB_USER, DB_PASS);
    //prepare sql statement
    $sql = 'SELECT * FROM vraag WHERE vraagid = :vraagid AND vraagid NOT IN (select vraagid from testvragen where 1)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':vraagid', $id);
    //test if statement can be executed
    if ($stmt->execute()) {
      //test if statement retrieved something
      $record = $stmt->fetch();
      if (!empty($record)) {
        //create object(s) and return
        //retrieve subcategory object
        $subcategory = SubcategoryService::getById($record['subcatid']);
        //retrieve answers for question
        $answers = AnswerService::getByQuestion($record['vraagid']);
        //retrieve media filename array for question
        $media = MediaService::getByQuestion($record['vraagid']);
        //create question object
        $question = new Question();
        $question->setId($record['vraagid']);
        $question->setText($record['vraagtekst']);
        $question->setWeight($record['gewicht']);
        $question->setSubcategory($subcategory);
        $question->setCorrectAnswer($record['correctantwoord']);
        $question->setAnswers($answers);
        $question->setMedia($media);
        $question->setActive((boolean) $record['actief']);
        return $question;
      } else {
        throw new ApplicationException('Deze vraag kan niet langer worden aangepast. Gelieve een nieuwe vraag aan te maken.');
      }
    } else {
      $error = $stmt->errorInfo();
      throw new ApplicationException('De vraag (' . $id . ') kon niet worden opgehaald, gelieve dit te controleren:<br>' . $error[2]);
    }
  }

}
