<?php

namespace Mctesting\Controller;
use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\UploadService;

/**
 * Description of homecontroller
 * 
 * Controller that shows the application homepage.
 *
 * @author Bram & Thomas
 */
class UploadController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function go()
    {
        //model
        $message1 = 'UPLOAD CODE FOR FREEEEEEE!!!!!!';
        $message2 = 'STARTFASE';
        if(isset($_SESSION["code"])){
            $message3 = $_SESSION["code"];
        }else{
            $message3 = 'Geen code';
        }

        //view
        $this->render('upload.html.twig', array(
            'message1' => $message1,
            'message2' => $message2,
            'message3' => $message3,

            ));
        //print_r($_SESSION);
        //var_dump($this->app->getUser());
    }
    public function upload()
    {
        $codeTeUploaden = $_POST["codeTeUploaden"];
       // $_SESSION["code"] = $_POST["codeTeUploaden"];
        
        if(UploadService::upload($codeTeUploaden)){
        UploadController::showResult($codeTeUploaden);
        //view

            
        }else{
            throw new ApplicationException('Wat doe jij nu :o');
        }
    }
    
    public function showResult($codeTeUploaden)
    {   
        
        $allUploads = UploadService::showUploads();
        $message1 = 'UPLOAD SUCCESSSSSSSS';
        $message2 = $codeTeUploaden;
        
        
        //view
        $this->render('upload.html.twig', array(
          //  'message1' => $message1,
            'allUploads'=>$allUploads,
            'message1' => $message1,
            'message2' => $message2,

            ));

    }
    

    
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }
}
