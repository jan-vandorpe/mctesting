<?php

namespace Mctesting\Controller;
use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\TestService;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\CategoryService;
use Mctesting\Model\Service\QuestionService;

/**
 * Description of testscontroller
 * 
 * Controller that handles everything test related
 *
 * @author Bram
 */
class TestsController extends AbstractController
{
    function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function go()
            /**
             * In case of bad redirect, show this
             */
    {
        //model
        $message1 = 'Landingspagina voor alles ivm de tests (hier zou je normaal niet moeten komen)';
        $message2 = "";

        //view
        $this->render('tests.html.twig', array(
            'message1' => $message1,
            'message2' => $message2,

            ));
        //print_r($_SESSION);
        //var_dump($this->app->getUser());
    }
    
    public function testCreation()
            /**
             * 
             */
    {
        //model
        $allCat = CategoryService::getAll();
        //view
        $this->render('testcreation.html.twig', array(
            'allCat'=>$allCat,
            
            ));
    }
    
    public function testCreation_step2()
            /**
             * 
             */
    {
        //model
        if(isset($_POST["testname"])&& isset($_POST["testcatselect"])){
        $_SESSION["testcreation"]["testname"] = $_POST["testname"];        
        $_SESSION["testcreation"]["catid"] = $_POST["testcatselect"];
        
        $testname = $_SESSION["testcreation"]["testname"];
        $catid = $_SESSION["testcreation"]["catid"];
        

        $allQuest = QuestionService::getByCategory($catid);
        
        
        //view
        $this->render('testcreation.html.twig', array(
            'allQuest'=>$allQuest,
            'testname'=>$testname,
            
            ));
        }else{
         header("location: /mctesting/tests/testcreation");   
           exit(0);   
        }
    }
    
    public function testCreation_step3()
            /**
             * 
             */
    {
        //model
        if(isset($_POST["testduration"])){
        $_SESSION["testcreation"]["testduration"] = $_POST["testduration"];
        $testname = $_SESSION["testcreation"]["testname"];
        $testduration = $_SESSION["testcreation"]["testduration"];
        //$catid = $_POST["testcatselect"];
        
        
        $questions = array();
        if(isset($_POST["question"])){
            $questions = $_POST["question"];
            $questioncount = 0;
            $questionWeightCount = 0;
            $_SESSION["subcatlist"]=array();
            foreach($questions as $question){
                //selectbyid
                $questionEntity=QuestionService::getById($question);
                $questionWeight=$questionEntity->getWeight();
                $questionSubcat=$questionEntity->getSubcategory()->getSubcatname();
                //$questionSubcat->subcatname();
                //$questionSubcat=$questionSubcat;
                //$_SESSION["subcatlist"][$questionSubcat]+=1;                
                if(isset($_SESSION["subcatlist"][$questionSubcat])){
                    $_SESSION["subcatlist"][$questionSubcat]["count"]++;
                    $_SESSION["subcatlist"][$questionSubcat]["weight"]+=$questionWeight;
                }else{
                    $_SESSION["subcatlist"][$questionSubcat]["count"]=1;
                    $_SESSION["subcatlist"][$questionSubcat]["weight"]=$questionWeight;
                    
                }
                $_SESSION["subcatlist"][$questionSubcat]["id"]=$questionEntity->getSubcategory()->getId();
                $questionWeightCount=$questionWeightCount + $questionWeight;
                $questioncount++;                
            }
            
            }
        $_SESSION["testcreation"]["questions"] = $questions;
        $_SESSION["testcreation"]["questioncount"] = $questioncount;
        $_SESSION["testcreation"]["questionweightcount"] = $questionWeightCount;
        
        
        //$allQuest = QuestionService::getByCategory($catid);
        $subcatlist=$_SESSION["subcatlist"];
        $catid = $_SESSION["testcreation"]["catid"];
        $cat = CategoryService::getById($catid);
//        print('<pre>');
//        var_dump($subcatlist);
//         print('</pre>');
        //view
        $this->render('testcreation.html.twig', array(
            //'allQuest'=>$allQuest,
            'testduration'=>$testduration,
            'testname'=>$testname,
            'questions'=>$questions,
            'cat'=>$cat,
            'questioncount'=>$questioncount,
            'questionweightcount'=>$questionWeightCount,
            'subcatlist' =>$subcatlist,
            
            ));
        }else{
          header("location: /mctesting/tests/testcreation");   
           exit(0);     
        }
    }
    
    public function testCreation_TestUpload()
            /**
             * 
             */
    {
//        foreach($_POST["subcatpasspercentage"] as $subcat){
//           $_SESSION["subcatlist"][$subcat->id]["passpercentage"]= $_POST["subcatpasspercentage"];
//        }
        $_POST["subcatpasspercentage"];
        //model
        $testname = $_SESSION["testcreation"]["testname"];
        $testduration = $_SESSION["testcreation"]["testduration"];
        $questioncount = $_SESSION["testcreation"]["questioncount"];
        $maxscore = $_SESSION["testcreation"]["questionweightcount"];
        $questions = $_SESSION["testcreation"]["questions"];
        $subcatlist=$_SESSION["subcatlist"];
        
        $admin = UserService::unserializeFromSession();
        $adminId = $admin->getRRNr();
        
        
            if(TestService::insertCreatedTestIntoDB($testname, $testduration, $questioncount, $maxscore, $adminId, $questions, $subcatlist)){
            
            
        //$_SESSION["testcreation"]["testduration"] = $_POST["testduration"];
        $testname = $_SESSION["testcreation"]["testname"];
        $testduration = $_SESSION["testcreation"]["testduration"];
        //$catid = $_POST["testcatselect"];
        
        $questions = array();
        if(isset($_POST["question"])){$questions = $_POST["question"];}

        //$allQuest = QuestionService::getByCategory($catid);
        $catid = $_SESSION["testcreation"]["catid"];
        $cat = CategoryService::getById($catid);
        
        //view
        $this->render('testcreation.html.twig', array(
            //'allQuest'=>$allQuest,
            'testduration'=>$testduration,
            'testname'=>$testname,
            'questions'=>$questions,
            'cat'=>$cat,
            'subcatlist' =>$subcatlist,
            
            ));
        }else{
          header("location: /mctesting/tests/testcreation");   
           exit(0);     
        }
    }
    
    
    
    public function testlink()
            /**
             * 
             */
    {
        //model
        if(isset($_SESSION["errormsg"])){
            $message=$_SESSION["errormsg"];
        }else{
            $message="";
        }
        $allTest = TestService::getAll();
        $allUsers = UserService::getAllUsers();
        //view
        $this->render('testlink.html.twig', array(
            'allTest'=>$allTest,
            'allUsers'=>$allUsers,
            'errormsg'=>$message,
            ));
    }
    
    
    public function testlinkadd()
            /**
             * Save created session to DB
             */
    {
        
        $testid=$_POST["testsetselect"];
        if($testid=="0"){
            $_SESSION["errormsg"] = "U moet een test selecteren";
           header("location: /mctesting/tests/testlink");   
           exit(0);
        }
        $datum=$_POST["testdatum"];
        $sessieww=$_POST["testwachtwoord"];
        $actief=1;
        $afgelegd = 0;
        $users = array();
        if(isset($_POST["user"])){$users = $_POST["user"];}
        
        //print_r($_SESSION);
        print("<pre>");
        var_dump($_POST);
        print("</pre>");
            if(TestService::insertCreatedTestSessionIntoDB($datum, $testid, $sessieww, $actief, $users,$afgelegd)){
                //             
            }else{
                //niet gelukt
            }
        
    }
    

    
    public function except()
    {
        throw new ApplicationException('Oh dear, controller says no.');
    }
}
