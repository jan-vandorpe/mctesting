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
    private $TestNaam;
    private $TestMaxDuur;
    private $TestAantalvragen;
    private $TestMaxscore;
    private $TestBeheerder;
    
    public function getTestId() {
        return $this->testId;
    }

    public function getTestNaam() {
        return $this->TestNaam;
    }
    public function getTestMaxDuur() {
        return $this->TestMaxDuur;
    }
    public function getTestAantalvragen() {
        return $this->TestAantalvragen;
    }
    public function getTestMaxscore() {
        return $this->TestMaxscore;
    }
    public function getTestBeheerder() {
        return $this->TestBeheerder;
    }

   

    public function setTestId($testId) {
        $this->testId = $testId;
    }
    public function setTestNaam($TestNaam) {
        $this->TestNaam = $TestNaam;
    }
    public function setTestMaxDuur($TestMaxDuur) {
        $this->TestMaxDuur = $TestMaxDuur;
    }
    public function setTestAantalvragen($TestAantalvragen) {
        $this->TestAantalvragen = $TestAantalvragen;
    }
    public function setTestMaxscore($TestMaxscore) {
        $this->TestMaxscore = $TestMaxscore;
    }
    public function setTestBeheerder($TestBeheerder) {
        $this->TestBeheerder = $TestBeheerder;
    }   
}
