<?php

namespace Mctesting\Model\Entity;

/**
 * Description of User
 *
 * @author Bram Peters
 */
class Test
{

    private $testId;
    private $TestName;
    private $TestMaxDuration;
    private $TestQuestionCount;
    private $TestMaxscore;
    private $TestPassPercentage;
    private $TestCreator;
    //private $TestCatName;
    private $status;
    private $published;

    function getPublished() {
        return $this->published;
    }

    function setPublished($published) {
        $this->published = $published;
    }

    public function getTestId()
    {
        return $this->testId;
    }

    public function getTestPassPercentage()
    {
        return $this->TestPassPercentage;
    }

    public function setTestPassPercentage($TestPassPercentage)
    {
        $this->TestPassPercentage = $TestPassPercentage;
    }

    public function getTestName()
    {
        return $this->TestName;
    }

    public function getTestMaxDuration()
    {
        return $this->TestMaxDuration;
    }

    public function getTestQuestionCount()
    {
        return $this->TestQuestionCount;
    }

    public function getTestMaxscore()
    {
        return $this->TestMaxscore;
    }

    public function getTestBeheerder()
    {
        return $this->TestCreator;
    }
//    public function getTestCatName()
//    {
//        return $this->TestCatName;
//    }
    
    public function getStatus() {
        return $this->status;
    }

    public function setTestId($testId)
    {
        $this->testId = $testId;
    }

    public function setTestName($TestName)
    {
        $this->TestName = $TestName;
    }

    public function setTestMaxDuration($TestMaxDuration)
    {
        $this->TestMaxDuration = $TestMaxDuration;
    }

    public function setTestQuestionCount($TestQuestionCount)
    {
        $this->TestQuestionCount = $TestQuestionCount;
    }

    public function setTestMaxscore($TestMaxscore)
    {
        $this->TestMaxscore = $TestMaxscore;
    }

    public function setTestCreator($TestCreator)
    {
        $this->TestCreator = $TestCreator;
    }

//    public function setTestCatName($TestCatName)
//    {
//        $this->TestCatName = $TestCatName;
//    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
}
