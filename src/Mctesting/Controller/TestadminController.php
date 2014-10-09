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
use Mctesting\Model\Entity\Category;
use Mctesting\Model\Service\TestQuestionService;

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
        header("location: " . ROOT . "/testadmin/testCreation_step1/new");
        exit(0);
    }

    public function testCreation_step1($arguments) {
        if ($arguments[0] == "new") {
            unset($_SESSION['testcreation']);
            $testcreation = new TestCreation;
            $test = new Test;
            $testcreation->setTest($test);
        } else if ($arguments[0] == "edit") {
            if (isset($_POST["selecttest"])) {
                $testcreation = new TestCreation;
                $testcreation->setTest(TestService::getById($_POST["selecttest"]));
                $cat = new Category;
                $cat->setId(CategoryService::getByTestId($testcreation->getTest()->getTestId()));
                $testcreation->setCat($cat);
                $questions = QuestionService::getByTest($testcreation->getTest()->getTestId());
                $testcreation->setQuestions($questions);
                $_SESSION["testcreation"] = serialize($testcreation);
                header("location: " . ROOT . "/testadmin/testCreation_step1");
                exit(0);
            } else {
                header("location: " . ROOT . "/testadmin/testCreation_step1/new");
                exit(0);
            }
        } else if (isset($_SESSION["testcreation"])) {
            $testcreation = unserialize($_SESSION["testcreation"]);
        } else {
            $testcreation = new TestCreation;
            $test = new Test;
            $testcreation->setTest($test);
        }

        $_SESSION["testcreation"] = serialize($testcreation);

        $allCat = CategoryService::getAllExceptEmpty();

        $this->render('testcreation.html.twig', array(
            'allCat' => $allCat,
            'testcreation' => $testcreation,
        ));
    }

    public function testCreation_step2() {
        if (isset($_SESSION["testcreation"])) {
            $testcreation = unserialize($_SESSION["testcreation"]);

            if ((isset($_POST["testname"]) && trim($_POST['testname']) != '') || $testcreation->getTest()->getTestName() != "") {
                if (isset($_POST["testname"])) {
                    $testcreation->getTest()->setTestName($_POST["testname"]);
                }

                if ((isset($_POST["testcatselect"]) && $_POST['testcatselect'] != 0) || $testcreation->getCat()->getId() != "") {
                    if (isset($_POST["testcatselect"]) && $_POST['testcatselect'] != 0) {
                        $cat = new Category;
                        $cat->setId($_POST["testcatselect"]);
                        $testcreation->setCat($cat);
                    } else {
                        $FMM = new FlashMessageManager();
                        $FMM->setFlashMessage('Gelieve een categorie te selecteren');
                        header("location: " . ROOT . "/testadmin/testCreation_step1/");
                        exit(0);
                    }
                    $testcreation->setSubCats(SubcategoryService::getActiveByCategoryId($testcreation->getCat()->getId()));

                    $_SESSION["testcreation"] = serialize($testcreation);

                    $this->render('testcreation2.html.twig', array(
                        'testcreation' => $testcreation,
                    ));
                } else {
                    $FMM = new FlashMessageManager();
                    $FMM->setFlashMessage('Gelieve een categorie te selecteren');
                    header("location: " . ROOT . "/testadmin/testCreation_step1/");
                    exit(0);
                }
            } else {
                $FMM = new FlashMessageManager();
                $FMM->setFlashMessage('Gelieve een naam in te vullen en een categorie te selecteren');
                header("location: " . ROOT . "/testadmin/testCreation_step1/");
                exit(0);
            }
        } else {
            header("location: " . ROOT . "/testadmin/testCreation_step1");
            exit(0);
        }
    }

    public function testCreation_step3() {
        if (isset($_SESSION["testcreation"])) {
            $testcreation = unserialize($_SESSION["testcreation"]);

            if (isset($_POST['back'])) {
                $testcreation->getTest()->setTestMaxDuration($_POST['testduration']);
                $testcreation->setQuestions($_POST['question']);
                $_SESSION["testcreation"] = serialize($testcreation);
                header("location: " . ROOT . "/testadmin/testCreation_step1");
                exit(0);
            }

            if (isset($_POST["testduration"])) {
                if (HelperFunctions::numbers_only($_POST['testduration']) == true) {
                    $testcreation->getTest()->setTestMaxDuration($_POST['testduration']);

                    if (isset($_POST["question"])) {
                        $testcreation->setQuestions($_POST['question']);
                        $testcreation->setQuestionweight(0);
                        $_SESSION["subcatlist"] = array();
                        foreach ($testcreation->getQuestions() as $question) {
                            //selectbyid
                            $questionEntity = QuestionService::getById($question);
                            $questionWeight = $questionEntity->getWeight();
                            $questionSubcat = $questionEntity->getSubcategory()->getSubcatname();

                            if (isset($_SESSION["subcatlist"][$questionSubcat])) {
                                $_SESSION["subcatlist"][$questionSubcat]["count"] ++;
                                $_SESSION["subcatlist"][$questionSubcat]["weight"]+=$questionWeight;
                            } else {
                                $_SESSION["subcatlist"][$questionSubcat]["count"] = 1;
                                $_SESSION["subcatlist"][$questionSubcat]["weight"] = $questionWeight;
                            }
                            $_SESSION["subcatlist"][$questionSubcat]["id"] = $questionEntity->getSubcategory()->getId();
                            $testcreation->setQuestionweight($testcreation->getQuestionweight() + $questionWeight);
                        }

                        $subcatlist = $_SESSION["subcatlist"];
                        $testcreation->setCat(CategoryService::getById($testcreation->getCat()->getId()));

                        if ($testcreation->getTest()->getTestBeheerder() != "") {
                            $subcatpasspercentage = SubcategoryService::getByTest($testcreation->getTest()->getTestId());
                            $testcreation->setSubcatspassperc($subcatpasspercentage);
                        }
                        $_SESSION["testcreation"] = serialize($testcreation);

                        //view
                        $this->render('testcreation3.html.twig', array(
                            'testcreation' => $testcreation,
                            'subcatlist' => $subcatlist,
                        ));
                    } else {
                        $FMM = new FlashMessageManager();
                        $FMM->setFlashMessage('Gelieve vragen te selecteren');
                        header("location: " . ROOT . "/testadmin/testCreation_step1/");
                        exit(0);
                    }
                } else {
                    $FMM = new FlashMessageManager();
                    $FMM->setFlashMessage('Tijdsduur moet een geheel getal zijn');
                    header("location: " . ROOT . "/testadmin/testCreation_step1/");
                    exit(0);
                }
            } else {
                $FMM = new FlashMessageManager();
                $FMM->setFlashMessage('Gelieve een tijdsduur in te vullen');
                header("location: " . ROOT . "/testadmin/testCreation_step1/");
                exit(0);
            }
        } else {
            header("location: " . ROOT . "/testadmin/testCreation_step1");
            exit(0);
        }
    }

    public function testCreation_TestUpload() {
        if (isset($_SESSION["testcreation"])) {
            $testcreation = unserialize($_SESSION["testcreation"]);

            if (isset($_POST['back'])) {
                $testcreation->getTest()->setTestPassPercentage($_POST["testpasspercentage"]);
                $testcreation->setSubcatspassperc($_POST['subcatpasspercentage']);

                $_SESSION["testcreation"] = serialize($testcreation);
                header("location: " . ROOT . "/testadmin/testCreation_step2");
                exit(0);
            }

            if (isset($_POST["subcatpasspercentage"])) {
                foreach ($_POST["subcatpasspercentage"] as $key => $value) {
                    if (HelperFunctions::numbers_only($value) == true && $value <= 100 && $value > 0) {
                        $_SESSION["subcatlist"][$key]["passpercentage"] = $value;
                    } else {
                        $FMM = new FlashMessageManager();
                        $FMM->setFlashMessage('De slaagpercentages moeten gehele getallen onder 100 zijn');
                        header("location: " . ROOT . "/testadmin/testCreation_step1/");
                        exit(0);
                    }
                }

                //model
                if (isset($_POST['testpasspercentage']) && HelperFunctions::numbers_only($_POST['testpasspercentage']) && $_POST['testpasspercentage'] <= 100 && $_POST['testpasspercentage'] > 0) {
                    $testcreation->getTest()->setTestPassPercentage($_POST["testpasspercentage"]);
                } else {
                    $FMM = new FlashMessageManager();
                    $FMM->setFlashMessage('De slaagpercentages moeten gehele getallen onder 100 zijn');
                    header("location: " . ROOT . "/testadmin/testCreation_step1/");
                    exit(0);
                }
                //exit(0);
                $subcatlist = $_SESSION["subcatlist"];

                if ($testcreation->getTest()->getTestBeheerder() != "") {
                    $adminId = $testcreation->getTest()->getTestBeheerder();
                    $testid = TestService::update($testcreation->getTest()->getTestId(), $testcreation->getTest()->getTestName(), $testcreation->getTest()->getTestMaxDuration(), count($testcreation->getQuestions()), $testcreation->getQuestionweight(), $testcreation->getTest()->getTestPassPercentage(), $adminId, $testcreation->getQuestions(), $subcatlist);
                } else {
                    $admin = UserService::unserializeFromSession();
                    $adminId = $admin->getRRNr();
                    $testid = TestService::create($testcreation->getTest()->getTestName(), $testcreation->getTest()->getTestMaxDuration(), count($testcreation->getQuestions()), $testcreation->getQuestionweight(), $testcreation->getTest()->getTestPassPercentage(), $adminId, $testcreation->getQuestions(), $subcatlist);
                }
                if (isset($_POST['publiceer'])) {
                    TestService::publish($testid);
                    unset($_SESSION['testcreation']);
                    header("location: " . ROOT . "/testadmin/testCreation_TestConfirm/" . $testid);
                    exit(0);
                } else {
                    $FMM = new FlashMessageManager();
                    $FMM->setFlashMessage('Test tijdelijk opgeslagen', 1);
                    unset($_SESSION['testcreation']);
                    header("location: " . ROOT . "/testadmin/testlist/");
                    exit(0);
                }
            } else {
                $FMM = new FlashMessageManager();
                $FMM->setFlashMessage('Gelieve de slaagpercentages in te vullen');
                header("location: " . ROOT . "/testadmin/testCreation_step1/");
                exit(0);
            }
        } else {
            header("location: " . ROOT . "/testadmin/testCreation_step1");
            exit(0);
        }
    }

    public function testCreation_TestConfirm($arguments) {
        $testid = $arguments[0];

        $this->render('testcreation4.html.twig', array(
            'testid' => $testid,
        ));
    }

    public function testselect() {
        unset($_SESSION['testcreation']);
        //retrieve tests
        $tests = TestService::getUnpublishedTests();
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
        $allTest = TestService::getAllPublished();
        $allUsers = UserService::getAllActiveUsers();
        $testsession = "";

        if (isset($_POST['selectsession'])) {
            $testsession = TestSessionService::getById($_POST['selectsession']);
        }


        //view
        $result = array();
        if ($allTest === false) {
            $FMM = new FlashMessageManager ();
            $FMM->setFlashMessage('Er zijn geen testen gevonden! <br> Gelieve een nieuwe test aan te maken voordat u een test plant.');
            header("location: " . ROOT . "/testadmin/testCreation_step1");
            exit(0);
        } else if ($allUsers === false) {
            $FMM = new FlashMessageManager ();
            $FMM->setFlashMessage('Er zijn geen gebruikers gevonden! <br> Gelieve een nieuwe gebruiker aan te maken voordat u een test plant.');
            header("location: " . ROOT . "/usermanagement/newuserform");
            exit(0);
        } else {
            foreach ($allTest as $test) {
                $catname = TestService::getCatName($test->getTestId());
                if (!isset($result[$catname])) {
                    $result[$catname] = array();
                }
                array_push($result[$catname], $test);
            }
        }
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

                    if (isset($_POST['aanpassen'])) {
                        $sessionid = $_POST["sessionid"];
                        if (TestSessionService::update($sessionid, $mysqldate, $testid, $sessieww, $users)) {
                            $FMM = new FlashMessageManager();
                            $FMM->setFlashMessage('Testsessie aangepast!<br>De testsessies aangepast. Gebruik het linkermenu om verder te werken.', 1);
                            header('Location:testselect');
                            exit(0);
                        }
                    } else {
                        if (TestSessionService::create($mysqldate, $testid, $sessieww, $users)) {
                            $FMM = new FlashMessageManager();
                            $FMM->setFlashMessage('Testsessie aangemaakt!<br>Er is een nieuwe testsessie aangemaakt. Gebruik het linkermenu om verder te werken.', 1);
                            header('Location:testlink');
                            exit(0);
                            //$this->render('testlinkconfirm.html.twig', array());             
                        }
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
        //unset($_COOKIE['fileDownloadToken']);
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

        $downloadTokenValue = $_GET['downloadId'];

//        header('Content-type: application/pdf');
//        header('Content-Disposition: attachment; filename="' . $testnaam . '.pdf"');

        setcookie("fileDownloadToken", $downloadTokenValue, time() + 500, '/');
        //var_dump($_COOKIE);
        //var_dump($_COOKIE['fileDownloadToken']);


        $pdf = new myPDF;
        $pdf->SetTitle($testnaam);
        //set author -- de gebruiker die momenteel aangemeld is
        //set creator -- degene die de test aangemaakt heeft
        //is normaal hetzelfde
        $pdf->SetSubject($testnaam);
        //mss datum
        //shuffle questions
        $test->shuffleQuestions();
        //shuffle answers
        $test->shuffleAnswers();

        $pdf->createMyPage($test, $catname);
    }
    
    public function testcopy(){
      foreach ($_POST['testCheckbox'] as $testid) {
            $test = TestService::getFullTestById($testid);
            $admin = UserService::unserializeFromSession();
            $adminId = $admin->getRRNr();
            $testname = $test->setTestName($test->getTestName().'_copy');
            $testduration = $test->getTestMaxDuration();
            $questioncount = $test->getTestQuestionCount();
            $maxscore = $test->getTestMaxScore();
            $passpercentage = $test->getTestPassPercentage();
            $questions = $test->getQuestions();
            $array = array();
            foreach ($test->getQuestions() as $question) {
                            //selectbyid
                            $questionId = $question->getId();
                            $questionWeight = $question->getWeight();
                            $questionSubcat = $question->getSubcategory()->getSubcatname();
                            if(isset($array["subcatlist"][$questionSubcat])){
                            $array["subcatlist"][$questionSubcat]["count"]++;
                            $array["subcatlist"][$questionSubcat]["weight"] += $questionWeight;
                            } else {
                            $array["subcatlist"][$questionSubcat]["count"] = 1;
                            $array["subcatlist"][$questionSubcat]["weight"] = $questionWeight;
                            }
                            $array["subcatlist"][$questionSubcat]["id"] = $questionId;
                            $array["subcatlist"][$questionSubcat]["id"] = $question->getSubcategory()->getId();
                        }
            $subcatlist = $array["subcatlist"];
            TestService::create($testname, $testduration, $questioncount, $maxscore, $passpercentage, $adminId, $questions, $subcatlist);
            
        }
    }

}
