<?php

namespace Mctesting\Model\Entity;

/***** Author: Bert Mortier *****/

class Subcategory {

    private $id;
    private $subcatname;
    private $category;

    public function getId() {
        return $this->id;
    }

    public function getSubcatname() {
        return $this->subcatname;
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
    
    public function setSubcatname($subcatname) {
        $this->subcatname = $subcatname;
    }

}
