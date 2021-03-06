<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Data\TestQuestionDAO;

/**
 * Description of UserService
 *
 * @author Bram Peters
 */
class TestQuestionService
{

    
    public static function create($testid, $questionId)
    {
        
        return TestQuestionDAO::insert($testid, $questionId);
    }
    
    public static function getAnsweredCats($sessieid, $userid, $testId)
    {        
        return TestQuestionDAO::selectCategoriesAnsweredQuestions($sessieid, $userid, $testId);
    }
    public static function remove($testid)
    {        
        return TestQuestionDAO::delete($testid);
    }
    
    public static function getTestCatsByTestId($testId){
      return TestQuestionDAO::getTestCategoriesByTestId($testId);
    }
}