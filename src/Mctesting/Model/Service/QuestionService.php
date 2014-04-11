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
    public static function getById($id)
    {
        return QuestionDAO::selectById($id);
    }
    
    public static function getBySubcategory($subcategoryId)
    {
        
    }
    
    public static function create($post)
    {
        //assign variables
        $subcatId =  $post['subcat'];
        $text = $post['vraag'];
        $weight = $post['gewicht'];
        $correctAnswerId = $post['correctant'];
        $answers = $post['antwoord'];
        $media = $post['media'];

        //test if answers not empty and is array
        if (!isset($post['answer']) || empty($post['answer']) || !is_array($post['answer'])) {
            throw new ApplicationException('answer variabele bestaat niet, is leeg of is geen array');
        }
        
        //test if media not empty and is array
        if (!isset($post['media']) || empty($post['media']) || !is_array($post['media'])) {
            throw new ApplicationException('media variabele bestaat niet, is leeg of is geen array');
        }
        
        //create question
        QuestionDAO::insert($text, $subcatId, $weight, $correctAnswerId, $answers, $media);
    }
    
    public static function validateCreate()
    {
        
    }
}
