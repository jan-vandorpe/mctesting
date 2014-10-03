<?php

namespace Mctesting\Model\Entity;
use Mctesting\Model\Service\QuestionService;

/* * *** Author: Bert Mortier **** */

class Subcategory
{

    private $id;
    private $subcatname;
    private $active;
    private $questions = array();
    private $questionCount;
    
    public function getQuestionCount() {
      return $this->questionCount;
    }

    public function setQuestionCount($questionCount) {
      $this->questionCount = $questionCount;
    }

    public function retrieveQuestionCount(){
      $this->setQuestionCount(QuestionService::getCountBySubcatId($this->id));
    }
        
    public function getId()
    {
        return $this->id;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getSubcatname()
    {
        return $this->subcatname;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function setSubcatname($subcatname)
    {
        $this->subcatname = $subcatname;
    }
    
    
    /**
     * Questions gebruikt om beantwoorde vragen per cat op te halen
     */
    public function getQuestions() {
        return $this->questions;
    }

    public function setQuestions($questions) {
        $this->questions = $questions;
    }

}
