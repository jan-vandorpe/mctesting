<?php

namespace Mctesting\Model\Entity;

/**
 * Description of FullTest
 *
 * @author cyber01
 */
class FullTest extends Test
{

    private $questions;

    public function getQuestions()
    {
        return $this->questions;
    }

    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

    public function shuffleQuestions()
    {
        shuffle($this->questions);
    }

    public function shuffleAnswers()
    {
        foreach ($this->questions as &$question) {
            $question->shuffleAnswers();
        }
    }

}
