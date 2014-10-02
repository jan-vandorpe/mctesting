<?php

namespace Mctesting\Model\Service;

use Mctesting\Model\Entity\Test;
use Mctesting\Model\Data\TestDAO;
use Mctesting\Model\Entity\UserSession;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\UserSessionService;
use Mctesting\Model\Service\TestSubcatService;
use Mctesting\Exception\ApplicationException;

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
    
    public static function getAllWithoutSessions()
    {
        return TestDAO::selectAllWithoutSessions();
    }
    
    public static function getAllWithSessions()
    {
        return TestDAO::selectAllWithSessions();
    }
    
    public static function getById($id)
    {
        return TestDAO::selectById($id);
    }
    
    public static function getByAdminId($adminId)
    {
        return TestDAO::selectByBeheerder($adminId);
    }
    
    public static function create($testname, $testduration, $questioncount, $maxscore,$passpercentage, $adminId, $questions, $subcatlist)
    {
        
        return TestDAO::insert($testname, $testduration, $questioncount, $maxscore,$passpercentage, $adminId, $questions, $subcatlist);
    }
    
    public static function getActiveFullTestById($id)
    {
        return TestDAO::selectActiveFullTestById($id);
    }
    
    public static function getCatName($testId)
    {
        return TestDAO::getCatName($testId);
    }
    
    /**
     * Process answers given by user.
     * 
     * @param type $test Test object containing all the questions
     * @param type $userAnswers Array with questionId as key and AnswerId as value
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
//            'passpercentage' => 0,
//            'subcategories' => array(
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
        $result['passpercentage'] = $test->getTestPassPercentage();
        $result['scoretotal'] = 0;
        
        // cycle test questions
        foreach ($test->getQuestions() as $question) {
            //retrieve subcat maxscore, passpercentage and initiliaze score to 0
            if (!isset($result['subcategories'][$question->getSubcategory()->getId()]['maxscore'])) {
                $testSubCat = TestSubcatService::getByTestANDSubcategory($test->getTestId(), $question->getSubcategory()->getId());
                $result['subcategories'][$question->getSubcategory()->getId()]['maxscore'] = $testSubCat['totalweight'];
                $result['subcategories'][$question->getSubcategory()->getId()]['passpercentage'] = $testSubCat['passpercentage'];
                $result['subcategories'][$question->getSubcategory()->getId()]['score'] = 0;
            }
            
            //check if answer was correct
            $correct = false;
            foreach ($userAnswers as $questionId => $userAnswer) {
                if ($question->getId() == $questionId && $question->getCorrectAnswer() == $userAnswer) {
                    $correct = true;
                    //update total score
                    $result['scoretotal'] += $question->getWeight();
                    //update subcat score
                    if (isset($result['subcategories'][$question->getSubcategory()->getId()]['score'])) {
                        $result['subcategories'][$question->getSubcategory()->getId()]['score'] += $question->getWeight();
                    } else {
                        $result['subcategories'][$question->getSubcategory()->getId()]['score'] = $question->getWeight();
                    }
                }
            }
            $result['answers'][$question->getId()] = $correct;
        }
        
        //calculate percentages
        //overall
        $score = (isset($result['scoretotal'])) ? (integer)$result['scoretotal'] : 0;
        $maxscore = (integer)$result['maxscoretotal'];
        $percentageTotal = TestService::calculatePercentage($score, $maxscore);
        //set percentages in result array
        $result['percentage'] = $percentageTotal;
        
        //per subcategory
        foreach ($result['subcategories'] as $subcatId => $subcatResults) {
            $score = (isset($subcatResults['score'])) ? (integer)$subcatResults['score'] : 0;
            $maxscore = (integer)$subcatResults['maxscore'];
            $percentage = TestService::calculatePercentage($score, $maxscore);
            $result['subcategories'][$subcatId]['percentage'] = $percentage;
        }
        
        //prepare usersession return values
        //set score
        $userSession->setScore($result['scoretotal']);
        
        //set percentage
        $userSession->setPercentage($result['percentage']);

        //set answers
        $userSession->setAnswers($result['answers']);
        
        //set participated
        $userSession->setParticipated(true);
        
        //set passed
        $userSession->setPassed(TestService::calculatePassFail($result));
        
        //persist into DB
        UserSessionService::update($userSession,$result['subcategories']);
        //persist subcat results into NON EXISTENT TABLE 
        
//        print '<pre>';
//        print_r($userSession);
//        print_r($result);
//        print '</pre>';
        
    }
    
    /**Calculate if user passed test based on results
     * 
     * @param type $results
     * @return type boolean
     */
    public static function calculatePassFail($results)
    {
        $passed = true;
        //check overall
        if ($results['percentage'] < $results['passpercentage']) {
            $passed = false;
        } else {
            //check per subcategory
            foreach ($results['subcategories'] as $subcatId => $subcatResults) {
                if ($subcatResults['percentage'] < $subcatResults['passpercentage']) {
                    $passed = false;
                }
            }
        }
        
        return $passed;
    }
    
    public static function calculatePercentage($score, $maxscore)
    {
        if ($maxscore != 0) {
            return round(( $score / $maxscore  * 100), 0);
        } else {
            throw new ApplicationException(
                    'TestService processAnswers method <br>'
                    . 'calculate percentages per subcategory <br>'
                    . 'DIVISION BY ZERO');
        }
    }
    
    public static function updateStatus($testid, $status) {
        if (TestDAO::updateStatus($testid, $status)) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function calculatePassFailManualEntry($percentageTotal,$userSession, $subcats){
      $pass = true;
      if($percentageTotal<$userSession[0]->getTestSession()->getTest()->getTestPassPercentage()){
        $pass = false;
      } else {
        foreach ($subcats as $subcat) {
          if($subcat->getPercentage()<$subcat->getPassPercentage()){
            $pass = false;
          }
        }
      }
      return $pass;
    }
}
