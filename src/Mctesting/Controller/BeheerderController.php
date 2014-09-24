<?php

namespace Mctesting\Controller;

use Framework\AbstractController;

class BeheerderController extends AbstractController {
    function __construct($app) {
        parent::__construct($app);
    }

    public function go() {
        $this->newBeheerderForm();
    }
    
    public function newBeheerderForm(){
        $this->render('newBeheerderform.html.twig', array());
    }
}
