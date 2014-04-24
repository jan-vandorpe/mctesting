<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Entity\Test;
use Mctesting\Model\Data\TestDAO;
use Mctesting\Model\Entity\UserSession;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\UserSessionService;

/**
 * Description of UserService
 *
 * @author Bram Peters
 */
class TestService
{
    
    public static function getAll()
    {
        return TestDAO::selectAll();
    }
    
    public static function getById($id)
    {
        return TestDAO::selectById($id);
    }
    
    public static function create($testname, $testduration, $questioncount, $maxscore,$passpercentage, $adminId, $questions, $subcatlist)
    {
        
        return TestDAO::insert($testname, $testduration, $questioncount, $maxscore,$passpercentage, $adminId, $questions, $subcatlist);
    }
    
    public static function getActiveFullTestById($id)
    {
        return TestDAO::selectActiveFullTestById($id);
    }
    
    /**
     * Function 
     * @param type $test Test object containing all the questions
     * @param type $userAnswers Array with questionId as keys and AnswerId as value
     */
    public static function processAnswers($test, $userAnswers)
    {
        print '<pre>';
        print_r($userAnswers);
        print '</pre>';
        //retrieve UserSession
        //$userResult = unserialize($_SESSION['testsession']);
        $userResult = new UserSession();
        //set user
        $userResult->setUser(UserService::unserializeFromSession());
        //set testsession
        
        //process answers
        $answers = array();
        $maxScore = 0;
        $score = 0;
        foreach ($test->getQuestions() as $question) {
            $maxScore += $question->getWeight();
            $correct = false;
            foreach ($userAnswers as $questionId => $userAnswer) {
                if ($question->getId() == $questionId && $question->getCorrectAnswer() == $userAnswer) {
                    $correct = true;
                    $score += $question->getWeight();
                }
            }
            $answers[$question->getId()] = $correct;
        }
        //set score
        $userResult->setScore($score);
        
        //set percentage
        $percentage = $score / $maxScore * 100;
        $userResult->setPercentage(round($percentage, 0));

        //set answers
        $userResult->setAnswers($answers);
        
        //set participated
        $userResult->setParticipated(true);
        
        //update + insert into DB
//        UserSessionService::update($userResult);
        
        print '<pre>';
        print_r($userResult);
        print '</pre>';
    }
}
