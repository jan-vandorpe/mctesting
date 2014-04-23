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


}
