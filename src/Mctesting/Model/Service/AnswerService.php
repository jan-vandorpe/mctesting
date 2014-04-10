<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\AnswerDAO;
//use Mctesting\Exception\ApplicationException;

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
    
    public static function create($questionId, $answers)
    {
//        if (is_array($answers)) {
            foreach ($answers as $id => $text) {
                AnswerDAO::insert($id, $questionId, $text);
            }
//        } else {
//            throw new ApplicationException('Parameter die antwoorden bevat is geen array');
//        }
    }
}
