<?php
namespace Mctesting\Model\Entity;

class AnsweredQuestion
{
    private $id;
    private $text;
    private $weight;
    private $media;
    private $correct;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function getMedia() {
        return $this->media;
    }

    public function setMedia($media) {
        $this->media = $media;
    }

    public function getCorrect() {
        return $this->correct;
    }

    public function setCorrect($correct) {
        $this->correct = $correct;
    }
}