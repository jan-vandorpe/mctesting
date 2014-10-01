<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\QuestionDAO;
use Mctesting\Exception\ApplicationException;

/**
 * Description of QuestionService
 *
 * @author cyber01
 */
class QuestionService
{

    /**
     * Function returns a question object corresponding to the given id.
     * @param type $id
     * @return type object
     */
    public static function getById($id)
    {
        return QuestionDAO::selectById($id);
    }

    public static function getByTest($testid)
    {
        return QuestionDAO::selectByTest($testid);
    }
    
    /**
     * Function returns an array of question objects corresponding to the given
     * categoryId
     * @param type $categoryId
     * @return type array
     */
    public static function getByCategory($categoryId)
    {
        return QuestionDAO::selectByCategory($categoryId);
    }

    public static function getBySubCategory($subCatId)
    {
        return QuestionDAO::selectBySubCategory($subCatId);
    }
    
    public static function getNotInTestBySubCategory($subCategoryId){
        return QuestionDAO::selectQuestionsNotInTestsBySubCategory($subCategoryId);
    }
    
    /**
     * Function returns an array of ACTIVE question objects corresponding to the given
     * categoryId
     * @param type $categoryId
     * @return type array
     */
    public static function getActiveByCategory($categoryId)
    {
        return QuestionDAO::selectActiveByCategory($categoryId);
    }

    /**
     * Function returns an array of ACTIVE question objects corresponding to the given
     * testId
     * @param type $categoryId
     * @return type array
     */
    public static function getActiveByTest($testId)
    {
        return QuestionDAO::selectActiveByTest($testId);
    }

    /**
     * The function takes the post values and assigns them to indiviual variables
     * to pass on to validation and after that the DAO.
     * IDs and numbers are typecast into integers.
     * The answers array is filtered for empty values.
     * The media array is checked if set and if not an empty array is initialized
     * 
     * @param type $post : $_POST values
     */
    public static function create($subcatId,$questionText,$weight,$correctAnswerId,$answersArray,$questionMediaFileNames)
    {
        
        //validate values
        if (QuestionService::validateNewQuestion($subcatId, $questionText, $weight, $correctAnswerId, $answersArray, $questionMediaFileNames)) {
            //create question
//            var_dump($subcatId);
//            var_dump($text);
//            var_dump($weight);
//            var_dump($correctAnswerId);
//            var_dump($answers);
//            var_dump($media);
            QuestionDAO::insert($questionText, $subcatId, $weight, $correctAnswerId, $answersArray, $questionMediaFileNames);
        }
    }

    /**
     * Validates given variables needed to insert a question in the DB.
     * If there are no validation issues the function returns true.
     * If any errors are generated they are displayed in an ApplicationException
     * 
     * @param type $subcatId
     * @param type $text
     * @param type $weight
     * @param type $correctAnswerId
     * @param type $answers
     * @param type $media
     * @return boolean
     * @throws ApplicationException
     */
    public static function validateNewQuestion($subcatId, $text, $weight, $correctAnswerId, $answers, $media)
    {
        $errors = array();

        //validate subcatId
        if ($subcatId === 0) {
            array_push($errors, 'Geen valide categorie gekozen');
        }

        //validate text
        if (empty($text) || $text === '') {
            array_push($errors, 'Vraag tekst mag niet leeg zijn');
        }

        //validate weight
        if ($weight < 1) {
            array_push($errors, 'Moeilijkheidsgraad moet groter dan 0 zijn');
        }

        //validate answers
        if(count($answers)<2) {
          array_push($errors, 'U moet minimum 2 antwoorden ingeven.');
        }
        
        $answerKeys = array();
        foreach($answers as $answer){
          if(empty($answer->getText())|$answer->getText() === ''){
            $id = $answer->getId() + 1;
            array_push($errors, 'Antwoorden moeten tekst bevatten. Antwoord '.$id.' is leeg');
          }
          array_push($answerKeys, $answer->getId());
        }
        if(array_search($correctAnswerId, $answerKeys) === false){
          array_push($errors, 'Correct antwoord kan niet gekoppeld worden aan een van de opgegeven antwoorden');
        }
        
        //validate media
        if (!empty($media) && !is_array($media)) {
            array_push($errors, 'media variabele is geen array');
        }

        //assess errors
        if (empty($errors)) {
            return true;  //set to true for prod
        } else {
            $errormsg = '';
            foreach ($errors as $key => $value) {
                if ($errormsg !== '') {
                    $errormsg .= '<br>';
                }
                $errormsg .= $value;
            }
            throw new ApplicationException($errormsg);
        }
    }
    
    public static function updateQuestion($editedQuestion){
      $subcatId = $editedQuestion->getSubcategory();
      $text = $editedQuestion->getText();
      $weight = $editedQuestion->getWeight();
      $correctAnswerId = $editedQuestion->getCorrectAnswer();
      $answers = $editedQuestion->getAnswers();
      $media = $editedQuestion->getMedia();
      if(QuestionService::validateNewQuestion($subcatId, $text, $weight, $correctAnswerId, $answers, $media)){
        QuestionDAO::updateQuestion($editedQuestion);
      }
    }

}
