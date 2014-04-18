<?php

namespace Mctesting\Model\Entity;

/**
 * Description of Question
 *
 * @author cyber01
 */
class Question
{

    private $id;
    private $text;
    private $weight;
    private $subcategory;
    private $correctAnswer;
    private $answers;
    private $media;
    private $active;

    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getSubcategory()
    {
        return $this->subcategory;
    }

    public function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }

    public function getAnswers()
    {
        return $this->answers;
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function setSubcategory($subcategory)
    {
        $this->subcategory = $subcategory;
    }

    public function setCorrectAnswer($correctAnswer)
    {
        $this->correctAnswer = $correctAnswer;
    }

    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }

    public function setMedia($media)
    {
        $this->media = $media;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

}
