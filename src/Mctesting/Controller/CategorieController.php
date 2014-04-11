<?php

namespace Mctesting\Controller;
use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\UserService;


/**
 * Description of Categoriecontroller
 * 
 * Controller that shows the Category & Subcategory page.
 *
 * @author Bram, Thomas & Bert
 */
class CategoryController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    public function go()
    {
        
        $this->render('category.html.twig', array(
            ));
    }

    
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }

}