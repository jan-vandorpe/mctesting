<?php

namespace Mctesting\Model\Entity;

use Mctesting\Model\Service\SubcategoryService;

class TestCreation
{
    private $test = "";
    private $cat = "";
    private $subcats = array();
    private $subcatspassperc = array();
    private $questions = array();
    private $questionweight = 0;
    
    function getQuestionweight() {
        return $this->questionweight;
    }

    function setQuestionweight($questionweight) {
        $this->questionweight = $questionweight;
    }

    function getCat() {
        return $this->cat;
    }

    function setCat($cat) {
        $this->cat = $cat;
    }

    function getSubcats() {
        return $this->subcats;
    }

    function setSubcats($subcats) {
        $this->subcats = $subcats;
    }

    function getTest() {
        return $this->test;
    }
   
    function getQuestions() {
        return $this->questions;
    }

    function setTest($test) {
        $this->test = $test;
    }

    function setQuestions($questions) {
        $this->questions = $questions;
    }

    function getSubcatspassperc() {
        return $this->subcatspassperc;
    }

    function setSubcatspassperc($subcatspassperc) {
        $this->subcatspassperc = $subcatspassperc;
    }
}
