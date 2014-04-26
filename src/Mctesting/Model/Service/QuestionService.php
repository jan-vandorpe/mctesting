<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\QuestionDAO;
use Mctesting\Exception\ApplicationException;
use Mctesting\Exception\FormException;

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
    public static function create($post)
    {
        //assign and typecast variables
        $subcatId =  (integer)$post['subcat'];
        $text = $post['vraag'];
        $weight = (integer)$post['gewicht'];
        $correctAnswerId = (integer)$post['correctant'];
        $answers = array_filter($post['antwoord']);
        $media = (isset($post['media'])) ? $post['media'] : array();
        
        //validate values
        if (QuestionService::validateNewQuestion($subcatId, $text, $weight, $correctAnswerId, $answers, $media)) {
            //create question
            QuestionDAO::insert($text, $subcatId, $weight, $correctAnswerId, $answers, $media);
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
            array_push($errors, 'subcatId mag niet 0 zijn');
        }
        
        //validate text
        if (empty($text) || $text === '' || $text === 'Vul hier uw vraag in') {
            array_push($errors, 'Vraagtekst niet ingevuld');
        }
        
        //validate weight
        if ($weight < 1) {
            array_push($errors, 'moeilijkheidsgraad moet groter dan 0 zijn');
        }

        //validate answers
        if (is_array($answers)) {
            if (empty($answers)) {
                array_push($errors, 'Geen antwoorden ingevuld');
            }
            //validate correctAnswerId
            if (!array_key_exists($correctAnswerId, $answers)) {
                array_push($errors, 'Correct antwoord kan niet gekoppeld worden aan een van de opgegeven antwoorden');
            } 
        } else {
            array_push($errors, 'Answers variabele is geen array');
        }

        //validate media
        if (!empty($media) && !is_array($media)) {
            array_push($errors, 'Media variabele is geen array');
        }
        
        //assess errors
        if (empty($errors)) {
            return true;
        } else {
            $errormsg = '';
            foreach ($errors as $key => $value) {
                if ($errormsg !== '') {
                    $errormsg .= PHP_EOL;
                }
                $errormsg .= $value;
            }
            throw new FormException($errormsg);
        }
    }
}
