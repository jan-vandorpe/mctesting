<?php

namespace Mctesting\Model\Entity;

/**
 * Description of Answer
 *
 * @author cyber01
 */
class Answer
{
    private $id;
    private $questionId;
    private $text;
    private $media;
    
    public function getMedia() {
      return $this->media;
    }

    public function setMedia($media) {
      $this->media = $media;
    }

        
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }
    public function getQuestionId()
    {
        return $this->questionId;
    }

    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;
    }
}
