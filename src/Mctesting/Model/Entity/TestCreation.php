<?php

namespace Mctesting\Model\Entity;

use Mctesting\Model\Service\SubcategoryService;

class TestCreation
{
    private $test;
    private $catId;
    private $subcats = array();
    private $questions = array();
    
    function getSubcats() {
        return $this->subcats;
    }

    function setSubcats($subcats) {
        $this->subcats = $subcats;
    }

    function getTest() {
        return $this->test;
    }

    function getCatId() {
        return $this->catId;
    }

    function getQuestions() {
        return $this->questions;
    }

    function setTest($test) {
        $this->test = $test;
    }

    function setCatId($catId) {
        $this->catId = $catId;
    }

    function setQuestions($questions) {
        $this->questions = $questions;
    }


}
