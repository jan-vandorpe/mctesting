<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\AnswerDAO;

/**
 * Description of AnswerService
 *
 * @author cyber01
 */
class AnswerService
{
    public static function getByQuestion($questionId)
    {
        return AnswerDAO::selectByQuestion($questionId);
    }
    
    public static function getSingleByQuestionAndId($questionId, $answerId)
    {
        return AnswerDAO::selectByQuestionAndId($questionId, $answerId);
    }
    
    public static function create($id, $questionId, $text)
    {
        AnswerDAO::insert($id, $questionId, $text);
    }
}
