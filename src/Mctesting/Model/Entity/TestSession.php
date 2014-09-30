<?php

namespace Mctesting\Model\Entity;

/**
 * Description of TestSession
 *
 * @author cyber01
 */

class TestSession
{
    private $id;
    private $date;
    private $test;
    private $password;
    private $active;
    private $users = array();
    
    function getUsers() {
        return $this->users;
    }

    function setUsers($users) {
        $this->users = $users;
    }

        public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTest()
    {
        return $this->test;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setTest($test)
    {
        $this->test = $test;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }
}
