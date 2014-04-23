<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mctesting\Model\Entity;

/**
 * Description of TestSessionUser
 *
 * @author cyber01
 */
class UserSession
{

    private $user;
    private $score;
    private $percentage;
    private $passed;
    private $participated;
    private $active;
    private $testSession;
    private $answers;

    public function getUser()
    {
        return $this->user;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function getPercentage()
    {
        return $this->percentage;
    }

    public function getPassed()
    {
        return $this->passed;
    }

    public function getParticipated()
    {
        return $this->participated;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getTestSession()
    {
        return $this->testSession;
    }

    public function setTestSession($testSession)
    {
        $this->testSession = $testSession;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setScore($score)
    {
        $this->score = $score;
    }

    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
    }

    public function setPassed($passed)
    {
        $this->passed = $passed;
    }

    public function setParticipated($participated)
    {
        $this->participated = $participated;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }
    
    public function getAnswers()
    {
        return $this->answers;
    }

    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }


}
