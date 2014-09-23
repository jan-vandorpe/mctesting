<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\UserSessionService;
use Mctesting\Model\Service\TestQuestionService;
use Mctesting\Model\Includes\UploadManager;
use Mctesting\Model\Includes\FlashMessageManager;

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
        $file_id = "csv";
        $folder = "../public/csv/";
        $types = "csv";
        $uploadedFile = UploadManager::upload($file_id, $folder, $types, $i = 0);
        $fileName = "$uploadedFile[0]";

        //als het een valid .csv file is
        if ($uploadedFile[1] == null) {
            $notValid = false;
            $file = fopen($folder . $fileName, "r");
            $i = 0;
            $fail = 0;
            $success = 0;
            $wrongdata = 0;
            $timestamp = date('Y-m-d G:i:s');

            //eerste lijn overslaan, hierin zitten de koppen
            fgetcsv($file, 1000, ";", "'");
            $statussen = array();


            //regel per regel de .csv file lezen
            while (!feof($file)) {
                $data[$i] = fgetcsv($file, 1000, ";", "'");

                $RRNr = $data[$i][0];
                $firstName = $data[$i][1];
                $lastName = $data[$i][2];
                $i++;

                //validaten of het geen lege regel is en of het RRNr wel klopt
                if ($firstName !== null and $lastName !== null && UserService::isValidRRNRFormat($RRNr) == true) {
                    if (UserService::getById($RRNr)) {
                        $status['fail'] = "Gebruiker '" . $firstName . " " . $lastName . "' met Rijksregisternummer '" . $RRNr . "' stond al in de database.";
                        array_push($statussen, $status);
                        $fail ++;
                    } else {
                        if (UserService::create($firstName, $lastName, $RRNr, $timestamp)) {
                            $_SESSION["importSucces"] = true;

                            $status['success'] = "toegevoegd <br>";
                            array_push($statussen, $status);
                            $success ++;
                        } else {
                            print ("fout");
                        }
                    }
                    //check for whitespaces
                } else {
                    if ($firstName != "" && $lastName != "" && $RRNr != "") {
                        $status['wrongdata'] = $i;
                        array_push($statussen, $status);
                        $wrongdata ++;
                    }
                }
            }


            fclose($file);
            $this->render('importstatus.html.twig', array("statussen" => $statussen, "fail" => $fail, "success" => $success, "notValid" => $notValid, "wrongdata" => $wrongdata));
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
        $userSessions = UserSessionService::getByUser($userid);

        //render page
        $this->render('user_showsessiondetail.html.twig', array(
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
        $subcategories = TestQuestionService::getAnsweredCats($sessionId, $userId);
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

    public function except() {
        throw new ApplicationException('Oh dear, controller says no.');
    }

}
