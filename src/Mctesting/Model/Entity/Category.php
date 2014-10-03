<?php

namespace Mctesting\Model\Entity;

use Mctesting\Model\Service\SubcategoryService;

/* * *** Author: Bert Mortier **** */

class Category
{

    private $id;
    private $catname;
    private $subcategories = array();
    private $active;

    public function getId()
    {
        return $this->id;
    }

    public function getSubcategories()
    {
        return $this->subcategories;
    }

    public function getCatname()
    {
        return $this->catname;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCatname($catname)
    {
        $this->catname = $catname;
    }

    public function setSubcategories($subcategories)
    {
        $this->subcategories = $subcategories;
    }

    public function retrieveSubcategories()
    {
        $this->subcategories = SubcategoryService::getByCategoryIdWithoutQuestions($this->id);
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

}
