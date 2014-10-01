<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\TestService;
use Mctesting\Model\Service\TestSessionService;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\CategoryService;
use Mctesting\Model\Service\SubcategoryService;
use Mctesting\Model\Service\QuestionService;
use Mctesting\Model\Includes\FlashMessageManager;
use Mctesting\Model\Includes\HelperFunctions;
use Mctesting\Model\Includes\myPDF;
use Mctesting\Model\Entity\TestCreation;
use Mctesting\Model\Entity\Test;

/**
 * Description of testscontroller
 * 
 * Controller that handles everything test related
 *
 * @author Bram
 */
class TestadminController extends AbstractController {

    function __construct($app) {
        parent::__construct($app);
    }

    public function go() {
        $this->testCreation();
    }

    public function testCreation() {
        unset($_SESSION['testcreation']);

        header("location: " . ROOT . "/testadmin/testCreation_step1");
        exit(0);
    }

    public function testCreation_step1() {
        if (isset($_SESSION["testcreation"])) {
            $testcreation = unserialize($_SESSION["testcreation"]);
        } else {
            $testcreation = new TestCreation;
            $test = new Test;
            $testcreation->setTest($test);

            $_SESSION["testcreation"] = serialize($testcreation);
        }
        if (isset($_POST["selecttest"])) {
            $testcreation->setTest(TestService::getById($_POST["selecttest"]));
            $testcreation->setCatId(CategoryService::getByTestId($testcreation->getTest()->getTestId()));

            $_SESSION["testcreation"] = serialize($testcreation);

            header("location: " . ROOT . "/testadmin/testCreation_step1");
            exit(0);
        }

        $allCat = CategoryService::getAllExceptEmpty();

        $this->render('testcreation.html.twig', array(
            'allCat' => $allCat,
            'testcreation' => $testcreation,
        ));
    }

    public function testCreation_step2() {
        if (isset($_SESSION["testcreation"])) {
            $testcreation = unserialize($_SESSION["testcreation"]);

            if (isset($_POST["testname"]) && trim($_POST['testname']) != '') {
                $testcreation->getTest()->setTestName($_POST["testname"]);

                if (isset($_POST["testcatselect"]) && $_POST['testcatselect'] != 0) {
                    $testcreation->setCatId($_POST["testcatselect"]);
                    $testcreation->setSubCats(SubcategoryService::getActiveByCategoryId($testcreation->getCatId()));

                    if (isset($_POST['testduration'])) {
                        $testCreation->getTest()->setTestMaxDuration($_POST['testduration']);
                    }
                    if (isset($_POST['question'])) {
                        $testCreation->setQuestions($_POST['question']);
                    }

                    $_SESSION["testcreation"] = serialize($testcreation);

                    $this->render('testcreation2.html.twig', array(
                        'testcreation' => $testcreation,
                    ));
                } else {
                    $FMM = new FlashMessageManager();
                    $FMM->setFlashMessage('Gelieve een categorie te selecteren');
                    header("location: " . ROOT . "/testadmin/testCreation_step1");
                    exit(0);
                }
            } else {
                $FMM = new FlashMessageManager();
                $FMM->setFlashMessage('Gelieve een naam in te vullen en een categorie te selecteren');
                header("location: " . ROOT . "/testadmin/testCreation_step1");
                exit(0);
            }
        } else {
            header("location: " . ROOT . "/testadmin/testCreation_step1");
            exit(0);
        }
    }

    public function testCreation_step3()
    /**
     * 
     */ {
        //model
        if (isset($_POST["testduration"])) {
            if (HelperFunctions::numbers_only($_POST['testduration']) == true) {

                $_SESSION["testcreation"]["testduration"] = $_POST["testduration"];
                $testduration = $_SESSION["testcreation"]["testduration"];

                $questions = array();
                if (isset($_POST["question"])) {
                    $_SESSION["testcreation"]["questions"] = $_POST["question"];
                    $questions = $_SESSION["testcreation"]["questions"];

                    $questioncount = 0;
                    $questionWeightCount = 0;

                    $_SESSION["subcatlist"] = array();
                    foreach ($questions as $question) {
                        //selectbyid
                        $questionEntity = QuestionService::getById($question);
                        $questionWeight = $questionEntity->getWeight();
                        $questionSubcat = $questionEntity->getSubcategory()->getSubcatname();
                        //$questionSubcat->subcatname();
                        //$questionSubcat=$questionSubcat;
                        //$_SESSION["subcatlist"][$questionSubcat]+=1;                
                        if (isset($_SESSION["subcatlist"][$questionSubcat])) {
                            $_SESSION["subcatlist"][$questionSubcat]["count"] ++;
                            $_SESSION["subcatlist"][$questionSubcat]["weight"]+=$questionWeight;
                        } else {
                            $_SESSION["subcatlist"][$questionSubcat]["count"] = 1;
                            $_SESSION["subcatlist"][$questionSubcat]["weight"] = $questionWeight;
                        }
                        $_SESSION["subcatlist"][$questionSubcat]["id"] = $questionEntity->getSubcategory()->getId();
                        $questionWeightCount = $questionWeightCount + $questionWeight;
                        $questioncount++;
                    }

                    $_SESSION["testcreation"]["questions"] = $questions;
                    $_SESSION["testcreation"]["questioncount"] = $questioncount;
                    $_SESSION["testcreation"]["questionweightcount"] = $questionWeightCount;


                    //$allQuest = QuestionService::getByCategory($catid);
                    $subcatlist = $_SESSION["subcatlist"];
                    $catid = $_SESSION["testcreation"]["catid"];
                    $testname = $_SESSION["testcreation"]["testname"];
                    $cat = CategoryService::getById($catid);

                    //view
                    $this->render('testcreation3.html.twig', array(
                        //'allQuest'=>$allQuest,
                        'testduration' => $testduration,
                        'testname' => $testname,
                        'questions' => $questions,
                        'cat' => $cat,
                        'questioncount' => $questioncount,
                        'questionweightcount' => $questionWeightCount,
                        'subcatlist' => $subcatlist,
                    ));
                } else {
                    throw new ApplicationException('Gelieve vragen te selecteren');
                }
            } else {
                throw new ApplicationException('Tijdsduur moet een geheel getal zijn');
            }
        } else {
            throw new ApplicationException('Gelieve een tijdsduur in te vullen');
        }
    }

    public function testCreation_TestUpload()
    /**
     * 
     */ {

        if (isset($_POST["subcatpasspercentage"])) {
            foreach ($_POST["subcatpasspercentage"] as $key => $value) {
                if (HelperFunctions::numbers_only($value) == true) {
                    $_SESSION["subcatlist"][$key]["passpercentage"] = $value;
                } else {
//              $FMM = new FlashMessageManager();
//              $FMM->setFlashMessage('De slaagpercentages moeten gehele getallen zijn test');
//              header('Location:'.ROOT.'/testadmin/testcreation_step3');
//              exit(0);
                    throw new ApplicationException('De slaagpercentages moeten gehele getallen zijn');
                }
            }
            //model
            if (isset($_POST['testpasspercentage']) && HelperFunctions::numbers_only($_POST['testpasspercentage'])) {
                $_SESSION["testcreation"]["passpercentage"] = $_POST["testpasspercentage"];
            } else {
                throw new ApplicationException('De slaagpercentages moeten gehele getallen zijn');
            }


            $passpercentage = $_SESSION["testcreation"]["passpercentage"];
            $testname = $_SESSION["testcreation"]["testname"];
            $testduration = $_SESSION["testcreation"]["testduration"];
            $questioncount = $_SESSION["testcreation"]["questioncount"];
            $maxscore = $_SESSION["testcreation"]["questionweightcount"];
            $questions = $_SESSION["testcreation"]["questions"];
            $subcatlist = $_SESSION["subcatlist"];

            $admin = UserService::unserializeFromSession();
            $adminId = $admin->getRRNr();


            $testid = TestService::create($testname, $testduration, $questioncount, $maxscore, $passpercentage, $adminId, $questions, $subcatlist);
            $testname = $_SESSION["testcreation"]["testname"];
            $testduration = $_SESSION["testcreation"]["testduration"];
            $questions = array();
            if (isset($_POST["question"])) {
                $questions = $_POST["question"];
            }
            $catid = $_SESSION["testcreation"]["catid"];
            $cat = CategoryService::getById($catid);
            //view
            $this->render('testcreation4.html.twig', array(
                //'allQuest'=>$allQuest,
                'passpercentage' => $passpercentage,
                'testid' => $testid,
                'testname' => $testname,
                'testduration' => $testduration,
                'questions' => $questions,
                'cat' => $cat,
                'subcatlist' => $subcatlist,
            ));
        } else {
            throw new ApplicationException('Gelieve de slaagpercentages in te vullen');
        }
    }

    public function testselect() {
        //build model
        //retrieve tests
        $tests = TestService::getAllWithoutSessions();
        $sessions = TestSessionService::getAllFiltered();

        //render page
        $this->render('test_select.html.twig', array(
            'tests' => $tests,
            'testsessions' => $sessions
        ));
    }

    public function testlink()
    /**
     * 
     */ {
        //model        
        $allTest = TestService::getAll();
        $allUsers = UserService::getAllUsers();
        $testsession = "";

        if (isset($_POST['selectsession'])) {
            $testsession = TestSessionService::getById($_POST['selectsession']);
        }
        $result = array();
        foreach ($allTest as $test) {
            $catname = TestService::getCatName($test->getTestId());
            if (!isset($result[$catname])) {
                $result[$catname] = array();
            }
            array_push($result[$catname], $test);
        }


        //view

        $this->render('testlink.html.twig', array(
            'allTest' => $result,
            'allUsers' => $allUsers,
            'testsession' => $testsession
        ));
    }

    public function testlinkadd()
    /**
     * Save created session to DB
     */ {

        if (isset($_POST['testsetselect']) && $_POST['testsetselect'] != 0) {
            $testid = $_POST["testsetselect"];
//        if ($testid == "0") {
//            $_SESSION["errormsg"] = "U moet een test selecteren";
//            header("location: ".ROOT."/testadmin/testlink");
//            exit(0);
//        }
            if (isset($_POST['testdatum']) && HelperFunctions::numbers_only(str_replace('/', '', $_POST['testdatum']))) {
                $date = explode('/', $_POST['testdatum']);
                $time = mktime(0, 0, 0, $date[1], $date[0], $date[2]);
                $mysqldate = date('Y-m-d H:i:s', $time);
//        var_dump($date);


                if (isset($_POST['testwachtwoord']) && trim($_POST['testwachtwoord']) != '') {
                    //throw new ApplicationException($_POST['testwachtwoord']);
                    $sessieww = $_POST["testwachtwoord"];
                    $actief = 1;
                    $afgelegd = 0;
                    $users = array();
                    if (isset($_POST["user"])) {
                        $users = $_POST["user"];
                    } else {
                        throw new ApplicationException('Gelieve gebruikers te selecteren');
                    }

                    //print_r($_SESSION);
//        print("<pre>");
//        var_dump($_POST);
//        print("</pre>");
                    if (TestSessionService::create($mysqldate, $testid, $sessieww, $users)) {
                        $FMM = new FlashMessageManager();
                        $FMM->setFlashMessage('Testsessie aangemaakt!<br>Er is een nieuwe testsessie aangemaakt. Gebruik het linkermenu om verder te werken.', 1);
                        header('Location:testlink');
                        exit(0);
                        //$this->render('testlinkconfirm.html.twig', array());             
                    } else {
                        //niet gelukt
                    }
                } else {
                    throw new ApplicationException('Gelieve een wachtwoord in te vullen');
                }
            } else {
                throw new ApplicationException('Gelieve een geldige datum in te vullen (dd/mm/yyyy)');
            }
        } else {
            throw new ApplicationException('Gelieve een test te kiezen');
        }
    }

    public function testlinkupdate()
    /**
     * update db
     */ {
        if (isset($_POST["sessionid"])) {
            $sessionid = $_POST["sessionid"];
            if (isset($_POST['testsetselect']) && $_POST['testsetselect'] != 0) {
                $testid = $_POST["testsetselect"];

                if (isset($_POST['testdatum']) && HelperFunctions::numbers_only(str_replace('/', '', $_POST['testdatum']))) {
                    $date = explode('/', $_POST['testdatum']);
                    $time = mktime(0, 0, 0, $date[1], $date[0], $date[2]);
                    $mysqldate = date('Y-m-d H:i:s', $time);

                    if (isset($_POST['testwachtwoord']) && trim($_POST['testwachtwoord']) != '') {
                        //throw new ApplicationException($_POST['testwachtwoord']);
                        $sessieww = $_POST["testwachtwoord"];
                        $actief = 1;
                        $afgelegd = 0;
                        $users = array();
                        if (isset($_POST["user"])) {
                            $users = $_POST["user"];
                        } else {
                            throw new ApplicationException('Gelieve gebruikers te selecteren');
                        }

                        if (TestSessionService::update($sessionid, $mysqldate, $testid, $sessieww, $users)) {
                            $FMM = new FlashMessageManager();
                            $FMM->setFlashMessage('Testsessie aangepast!<br>De testsessies aangepast. Gebruik het linkermenu om verder te werken.', 1);
                            header('Location:testselect');
                            exit(0);
                        } else {
                            //niet gelukt
                        }
                    } else {
                        throw new ApplicationException('Gelieve een wachtwoord in te vullen');
                    }
                } else {
                    throw new ApplicationException('Gelieve een geldige datum in te vullen (dd/mm/yyyy)');
                }
            } else {
                throw new ApplicationException('Gelieve een test te kiezen');
            }
        } else {
            header('Location:testlink');
            exit(0);
        }
    }

    /**
     * Overzicht gemaakte testen weergeven
     */
    public function testlist() {
        unset($_SESSION['test']);
        $admin = UserService::unserializeFromSession();
        $adminId = $admin->getRRNr();

        if ($admin->getGroup()->getId() == 3) {
            $tests = TestService::getAll();
        } else {
            $tests = TestService::getByAdminId($adminId);
        }

        $this->render('testlist.html.twig', array(
            'tests' => $tests,
        ));
    }

    //make test active
    public function inactive() {
        foreach ($_POST['testCheckbox'] as $check) {
            TestService::updateStatus($check, 0);
            header("location: " . ROOT . "/testadmin/testlist");
        }
    }

    //make test active
    public function active() {
        foreach ($_POST['testCheckbox'] as $check) {
            TestService::updateStatus($check, 1);
            header("location: " . ROOT . "/testadmin/testlist");
        }
    }

    public function except() {
        throw new ApplicationException('Oh dear, controller says no.');
    }

    public function generatepdf($arguments) {

        $testId = $arguments[0];


        $test = TestService::getActiveFullTestById($testId);
        $catname = TestService::getCatName($test->getTestId());

        //var_dump($test);

        $testnaam = $test->getTestName();
        $pdf = new myPDF;
        $pdf->SetTitle($testnaam);
        //set author -- de gebruiker die momenteel aangemeld is
        //set creator -- degene die de test aangemaakt heeft
        //is normaal hetzelfde
        $pdf->SetSubject($testnaam);
        //mss datum
        $pdf->createMyPage($test, $catname);
    }

}
