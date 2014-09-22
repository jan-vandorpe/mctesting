<?php

namespace Mctesting\Controller;

use Framework\AbstractController;
use Mctesting\Exception\ApplicationException;
use Mctesting\Model\Service\UserService;
use Mctesting\Model\Service\UserSessionService;

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
        $this->render('usermanagement.html.twig', array(
                // 'message1' => $message1,
        ));
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
                        if (UserService::create($firstName, $lastName, $RRNr)) {
                            $_SESSION["importSucces"] = true;

                            $status['success'] = "toegevoegd <br>";
                            array_push($statussen, $status);
                            $success ++;
                        } else {
                            print("fout");
                        }
                    }
                }
            }

            fclose($file);
            $this->render('importstatus.html.twig', array("statussen" => $statussen, "fail" => $fail, "success" => $success, "notValid" => $notValid));
        } else {
            $notValid = true;
            $this->render('importstatus.html.twig', array("notValid" => $notValid));
        }

    }

    public function newUser() {
        $firstName = $_POST["vnaam"];
        $lastName = $_POST["fnaam"];
        $RRNr = $_POST["rrnr"];

        if ($firstName !== null and $lastName !== null and UserService::isValidRRNRFormat($RRNr) == true) {
            if (UserService::create($firstName, $lastName, $RRNr)) {
                header("location: " . ROOT . "/usermanagement/listusers");
            } else {
                //header("location: ".ROOT."/home/newuserform");
                //echo("lolz");
            }
        } else {
            print ("Niet valid.");
        }
    }

    public function registerUser() {
        $firstName = $_POST["vnaam"];
        $lastName = $_POST["fnaam"];
        $RRNr = $_POST["rrnr"];

        if ($firstName !== null and $lastName !== null and UserService::isValidRRNRFormat($RRNr) == true) {
            if (UserService::create($firstName, $lastName, $RRNr)) {
                header("location: " . ROOT . "/home/go");
            } else {
                //header("location: ".ROOT."/home/newuserform");
                //echo("lolz");
            }
        } else {
            print ("Niet valid.");
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

    public function userdetails($arguments){        
        
        $userid = $arguments[0];
        $userSessions = UserSessionService::getByUser($userid);
        
        //render page
        $this->render('userdetails.html.twig', array(
            'usersessions' => $userSessions,
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
