<?php

namespace Mctesting\Model\Entity;

/**
 * Description of User
 *
 * @author Thomas Deserranno
 */
class Code
{
    private $code;
    private $nummer;
    
    public function getNummer() {
        return $this->nummer;
    }

    public function getCode() {
        return $this->code;
    }

   

    public function setNummer($nummer) {
        $this->nummer = $nummer;
    }

    public function setCode($code) {
        $this->code = $code;
    }

   
}
