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
//            var_dump($subcatId);
//            var_dump($text);
//            var_dump($weight);
//            var_dump($correctAnswerId);
//            var_dump($answers);
//            var_dump($media);
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
        if (empty($text) || $text === '') {
            array_push($errors, 'vraag tekst mag niet leeg zijn');
        }
        
        //validate weight
        if ($weight < 1) {
            array_push($errors, 'moeilijkheidsgraad moet groter dan 0 zijn');
        }

        //validate answers
        if (is_array($answers)) {
            if (empty($answers)) {
                array_push($errors, 'answers array is leeg');
            }
            //validate correctAnswerId
            if (!array_key_exists($correctAnswerId, $answers)) {
                array_push($errors, 'correct antwoord kan niet gekoppeld worden aan een van de opgegeven antwoorden');
            } 
        } else {
            array_push($errors, 'answers variabele is geen array');
        }

        //validate media
        if (!empty($media) && !is_array($media)) {
            array_push($errors, 'media variabele is geen array');
        }
        
        //assess errors
        if (empty($errors)) {
            return true;
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
}
