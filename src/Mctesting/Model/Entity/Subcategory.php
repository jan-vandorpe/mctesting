<?php

namespace Mctesting\Model\Entity;

/* * *** Author: Bert Mortier **** */

class Subcategory
{

    private $id;
    private $subcatname;
    private $active;

    //category unused since subcategories are contained by category object(s)
//    private $category;

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

//    public function getCategory() {
//        return $this->category;
//    }

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

}
