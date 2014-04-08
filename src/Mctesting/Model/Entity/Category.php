<?php

namespace Mctesting\Model\Entity;

/***** Author: Bert Mortier *****/

class Category {

    private $id;
    private $category;

    public function getId() {
        return $this->id;
    }
    
    public function getCategory() {
        return $this->category;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    public function setCategory($category) {
        $this->category = $category;
    }

}
