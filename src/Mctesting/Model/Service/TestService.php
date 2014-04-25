<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Entity\Test;
use Mctesting\Model\Data\TestDAO;
use Mctesting\Model\Entity\UserSession;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\UserSessionService;
use Mctesting\Model\Service\TestSubcatService;

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
    public static function processAnswers($test, $userAnswers, $userSession)
    {
//        print '<pre>';
//        print_r($userAnswers);
//        print '</pre>';
        
        //results array
        $result = array();
//        $result = array(
//            'scoretotal' => 0,
//            'maxscoretotal' => 0,
//            'subcatscores' => array(
//                    array(0, array(
//                        'score' => 0,
//                        'maxscore' => 0,
//                        'neededpercentage' => 0,
//                        )
//                ),
//            ),
//            'answers' => array(),
//        );
        
        //initialize result array values
        $result['answers'] = array();
        $result['maxscoretotal'] = $test->getTestMaxscore();
        $result['scoretotal'] = 0;
        
        // cycle test questions
        foreach ($test->getQuestions() as $question) {
            //retrieve subcat maxscore
            if (!isset($result['subcatscores'][$question->getSubcategory()->getId()]['maxscore'])) {
//                TO BE MODIFIED BASED ON CODE THAT DOES NOT EXIST YET
                $testSubCat = TestSubcatService::getByTestANDSubcategory($test->getTestId(), $question->getSubcategory()->getId());
//                $result['subcatscores'][$question->getSubcategory()->getId()]['maxscore'] = $testSubCat->getTotalWeight();
//                $result['subcatscores'][$question->getSubcategory()->getId()]['passpercentage'] = $testSubCat->getPassPercentage();
            }
            
            //check if answer was correct
            $correct = false;
            foreach ($userAnswers as $questionId => $userAnswer) {
                if ($question->getId() == $questionId && $question->getCorrectAnswer() == $userAnswer) {
                    $correct = true;
                    //update total score
                    $result['scoretotal'] += $question->getWeight();
                    //update subcat score
                    if (isset($result['subcatscores'][$question->getSubcategory()->getId()]['score'])) {
                        $result['subcatscores'][$question->getSubcategory()->getId()]['score'] += $question->getWeight();
                    } else {
                        $result['subcatscores'][$question->getSubcategory()->getId()]['score'] = $question->getWeight();
                    }
                }
            }
            $result['answers'][$question->getId()] = $correct;
        }
        
        //prepare usersession return values
        //set score
        $userSession->setScore($result['scoretotal']);
        
        //set percentage
        $percentage = $result['scoretotal'] / $result['maxscoretotal'] * 100;
        $userSession->setPercentage(round($percentage, 0));

        //set answers
        $userSession->setAnswers($result['answers']);
        
        //set participated
        $userSession->setParticipated(true);
        
        
        //persist into DB
//        UserSessionService::update($userSession);
        
        print '<pre>';
//        print_r($userSession);
        print_r($testSubCat);
        print_r($result);
        print '</pre>';
        
    }
}
