<?php

namespace Mctesting\Model\Entity;

/**
 * Description of User
 *
 * @author Thomas Deserranno
 */
class User {

    private $RRnr;
    private $firstName;
    private $lastName;
    private $email;
    private $group;
    private $status;

    public function getRRnr() {
        return $this->RRnr;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getGroup() {
        return $this->group;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setRRnr($RRnr) {
        $this->RRnr = $RRnr;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setGroup($group) {
        $this->group = $group;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}
