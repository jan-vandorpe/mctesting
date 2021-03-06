<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\UserSessionService;
use Mctesting\Model\Service\TestQuestionService;
use Mctesting\Model\Includes\UploadManager;
use Mctesting\Model\Includes\FlashMessageManager;
use Mctesting\Model\Entity\User;
use Mctesting\Model\Service\BeheerderService;

/**
 * Description of homecontroller
 * 
 * Controller that shows the application homepage.
 *
 * @author Bram
 * 
 * Beheer van gebruikers die een test willen afleggen (basisgebruikers)
 * 
 */
class UsermanagementController extends AbstractController {

    function __construct($app) {
        parent::__construct($app);
    }

    public function go() {
        $this->newUserForm();
    }

    public function newUserForm() {
        $this->render('newuserform.html.twig', array(
                // 'message1' => $message1,
        ));
    }

    public function importUsers() {
        $this->render('importusers.html.twig', array(
        ));
    }

    public function importStatus($statussen) {
//        $this->render('importstatus.html.twig', array("statussen" => $statussen));
    }

    public function import() {

        //upload file
        $originalName = $_POST['filename'];
        $file_id = "csv";
        $folder = "../public/csv/";
        $types = "csv";
        $uploadedFile = UploadManager::upload($file_id, $folder, $types, $i = 0);
        $fileName = "$uploadedFile[0]";

        //als het een valid .csv file is
        if ($uploadedFile[1] == null) {
            ini_set('auto_detect_line_endings', true);
            $notValid = false;
            $file = fopen($folder . $fileName, "r");
            $fail = 0;
            $success = 0;
            $wrongdata = 0;
            $timestamp = date('Y-m-d G:i:s');

            //eerste lijn overslaan, hierin zitten de koppen
            fgetcsv($file, 1000, ";", "'");
            $failStatussen = array();
            $wrongDataStatussen = array();
            $successStatussen = array();


            //regel per regel de .csv file lezen
            while (!feof($file)) {

                $data = fgetcsv($file, 1000, ";", "'");
                $formatRRNr = str_replace(".", "", $data[0]);
                $formatRRNr = str_replace("-", "", $formatRRNr);
                $formatRRNr = str_replace("/", "", $formatRRNr);
                $formatRRNr = str_replace(",", "", $formatRRNr);
                $RRNr = $formatRRNr;

                if (isset($data[1])) {
                    $firstName = trim(mb_convert_encoding($data[1], "ISO-8859-1"));
                }

                if (isset($data[2])) {
                    $lastName = trim(mb_convert_encoding($data[2], "ISO-8859-1"));
                }

                //validaten of het geen lege regel is en of het RRNr wel klopt
                if (isset($firstName) && $firstName != null and isset($lastName) && $lastName != null && UserService::isValidRRNRFormat($RRNr) == true) {
                    if (UserService::getById($RRNr)) {
//                      
                        $status['RRnr'] = $RRNr;
                        $status['voornaam'] = $firstName;
                        $status['familienaam'] = $lastName;
                        array_push($failStatussen, $status);

                        $fail ++;
                    } else {
                        if (UserService::createCSVuser(mb_convert_encoding($firstName, "UTF-8"), mb_convert_encoding($lastName, "UTF-8"), $RRNr, $timestamp)) {
                            $_SESSION["importSucces"] = true;

                            $status['RRnr'] = $RRNr;
                            $status['voornaam'] = $firstName;
                            $status['familienaam'] = $lastName;
                            array_push($successStatussen, $status);

                            $success ++;
                        } else {
                            print ("fout");
                        }
                    }
                    //check for whitespaces
                } else {
                    if (isset($firstName) && $firstName != "" && $lastName != "" && $RRNr != "") {
                        $status['RRnr'] = $RRNr;
                        $status['voornaam'] = $firstName;
                        $status['familienaam'] = $lastName;

                        array_push($wrongDataStatussen, $status);
                        $wrongdata ++;
                    }
                }
            }
            fclose($file);
            //delete temporary file
            unlink($folder . $fileName);
            //var_dump($failStatussen);
            $this->render('importstatus.html.twig', array("failStatussen" => $failStatussen, "fail" => $fail, "success" => $success, "notValid" => $notValid,
                "wrongdata" => $wrongdata, "filename" => $originalName, "successStatussen" => $successStatussen, "wrongDataStatussen" => $wrongDataStatussen));
        } else {
//            $notValid = true;
//            $this->render('importstatus.html.twig', array("notValid" => $notValid));
            throw new ApplicationException('Dit is geen geldig .CSV bestand!');
        }
    }

    public function newUser() {
        if (isset($_POST["vnaam"]) && isset($_POST["fnaam"]) && isset($_POST["rrnr"])) {
            $firstName = $_POST["vnaam"];
            $lastName = $_POST["fnaam"];
            $RRNr = $_POST["rrnr"];
            $timestamp = date('Y-m-d G:i:s');
            if (UserService::validateUser($firstName, $lastName, $RRNr, $timestamp) == true) {
                header("location: " . ROOT . "/usermanagement/listusers");
            }
        } else {
            throw new ApplicationException('Gelieve alle vakjes in te vullen');
        }
    }

    public function updateUser() {
        if (isset($_POST["vnaam"]) && isset($_POST["fnaam"]) && isset($_POST["rrnr"])) {
            $user = new User();
            $user->setRRnr($_POST["rrnr"]);
            $user->setFirstName($_POST["vnaam"]);
            $user->setLastName($_POST["fnaam"]);

            if (UserService::updateUser($user)) {
                $FMM = new FlashMessageManager();
                $FMM->setFlashMessage('Gebruiker succesvol aangepast', 1);
                header("location: " . ROOT . "/usermanagement/userdetails/" . $user->getRRnr());
            }
        } else {
            throw new ApplicationException('Gelieve alle velden in te vullen');
        }
    }

    //make user inactive
    public function inactive() {
        foreach ($_POST['userCheckbox'] as $check) {
            UserService::updateStatus($check, 0);
            // array_push($RRNrs, $check);
            header("location: " . ROOT . "/usermanagement/listusers");
        }
    }

    //make user active
    public function active() {
        foreach ($_POST['userCheckbox'] as $check) {
            UserService::updateStatus($check, 1);
            // array_push($RRNrs, $check);
            header("location: " . ROOT . "/usermanagement/listusers");
        }
    }

    //delete user
    public function delete() {
        foreach ($_POST['userCheckbox'] as $check) {
            UserService::deleteUser($check);
            // array_push($RRNrs, $check);
            header("location: " . ROOT . "/usermanagement/listusers");
        }
    }

    //UserService::loginCheck($login, $password);
    //header("location: ".ROOT."/home/go");        

    public function userdetails($arguments) {

        $userid = $arguments[0];
        $user = UserService::getById($userid);
        $userSessions = UserSessionService::getByUser($userid);

        //render page
        $this->render('user_showsessiondetail.html.twig', array(
            'user' => $user,
            'usersessions' => $userSessions,
        ));
    }

    public function showUserRapport($arguments) {
        /**
         * Scores per gebruiker tonen
         */
        $sessionId = $arguments[0];
        $userId = $arguments[1];

        //build model
        //retrieve
        $userSession = UserSessionService::getByUserANDSession($sessionId, $userId);
        if ($userSession === false) {
            throw new ApplicationException('Er zijn geen testsessies gevonden voor deze combinatie van gebruiker en sessie');
        }
        $testId = $userSession[0]->getTestSession()->getTest()->getTestId();
        $subcategories = TestQuestionService::getAnsweredCats($sessionId, $userId, $testId);
        //var_dump($userSession);
        //var_dump($subcategories);
        //var_dump($userId);
        //render page
        $this->render('user_userrapport.html.twig', array(
            'usersession' => $userSession,
            'subcats' => $subcategories,
        ));
    }

    public function listusers() {
        //model
        //$message1 = 'It works!';
        $allUsers = UserService::getAllUsers();


        //view
        $this->render('userlist.html.twig', array(
            //  'message1' => $message1,
            'allUsers' => $allUsers,
        ));
        //print_r($_SESSION);
        //var_dump($this->app->getUser());
    }

    public function accountdetails($arguments) {

        $userid = $arguments[0];
        $user = UserService::getById($userid);

        //render page
        $this->render('beheerder_accountpage.html.twig', array(
            'user' => $user,
        ));
    }

    public function changepassword() {
        if (isset($_POST["rrnr"])) {
            $rrnr = $_POST["rrnr"];

            if (isset($_POST["wachtwoord1"])) {
                if (isset($_POST["wachtwoord2"])) {
                    $wachtwoord1 = $_POST["wachtwoord1"];
                    $wachtwoord2 = $_POST["wachtwoord2"];

                    if (preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]{4,})$/i', $wachtwoord1)) {
                        if ($wachtwoord1 == $wachtwoord2) {
                            if (BeheerderService::changePassword($rrnr, $wachtwoord1)) {
                                unset($_SESSION['pwreset']);
                                $FMM = new FlashMessageManager();
                                $FMM->setFlashMessage('Wachtwoord succesvol aangepast', 1);
                                header("location: " . ROOT . "/usermanagement/accountdetails/" . $rrnr);
                            }
                        } else {
                            throw new ApplicationException('De wachtwoorden komen niet overeen');
                        }
                    } else {
                        throw new ApplicationException('Het wachtwoord moet minstens 4 tekens, waaronder minstens 1 cijfer bevatten (geen spatie, geen speciale tekens)');
                    }
                } else {
                    throw new ApplicationException('Gelieve het wachtwoord opnieuw in te vullen');
                }
            } else {
                throw new ApplicationException('Gelieve het wachtwoord in te vullen');
            }
        }
    }

    public function updateBeheerder() {
        if (isset($_POST["vnaam"]) && isset($_POST["fnaam"]) && isset($_POST["rrnr"]) && isset($_POST["email"])) {

            $rrnr = $_POST["rrnr"];
            $user = UserService::getById($rrnr);

            $user->setFirstName($_POST["vnaam"]);
            $user->setLastName($_POST["fnaam"]);
            $user->setEmail($_POST["email"]);
            $user->setGroup($user->getGroup()->getId());

            if (BeheerderService::updateBeheerder($user)) {
                $FMM = new FlashMessageManager();
                $FMM->setFlashMessage('Account succesvol aangepast', 1);
                header("location: " . ROOT . "/usermanagement/accountdetails/" . $rrnr);
            }
        } else {
            throw new ApplicationException('Gelieve alle velden in te vullen');
        }
    }

    public function except() {
        throw new ApplicationException('Oh dear, controller says no.');
    }

}
