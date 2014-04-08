<?php

namespace Mctesting\Model\Entity;

/***** Author: Bert Mortier *****/

class Subcategory {

    private $id;
    private $subcategory;
    private $category;

    public function getId() {
        return $this->id;
    }

    public function getSubcategory() {
        return $this->subcategory;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setSubcategory($subcategory) {
        $this->subcategory = $subcategory;
    }

}
