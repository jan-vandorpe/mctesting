<?php

namespace Mctesting\Model\Entity;

/* * *** Author: Bert Mortier **** */

class Subcategory
{

    private $id;
    private $subcatname;
    private $active;

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
