<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>

    </head>
    <body>
        <?php
        require_once '../src/Mctesting/Model/Service/AnswerService.php';
        require_once '../src/Mctesting/Model/Data/AnswerDAO.php';
        require_once '../src/Mctesting/Model/Entity/Answer.php';
        require_once '../src/Mctesting/Model/Service/QuestionService.php';
        require_once '../src/Mctesting/Model/Data/QuestionDAO.php';
        require_once '../src/Mctesting/Model/Entity/Question.php';
        require_once '../src/Mctesting/Model/Service/SubcategoryService.php';
        require_once '../src/Mctesting/Model/Data/SubcategoryDAO.php';
        require_once '../src/Mctesting/Model/Entity/Subcategory.php';
        require_once '../src/Mctesting/Model/Service/CategoryService.php';
        require_once '../src/Mctesting/Model/Data/CategoryDAO.php';
        require_once '../src/Mctesting/Model/Entity/Category.php';
        require_once '../src/Mctesting/Model/Service/MediaService.php';
        require_once '../src/Mctesting/Model/Data/MediaDAO.php';
        require_once '../src/Mctesting/Config/Config.php';
        require_once '../src/Mctesting/Exception/ApplicationException.php';





        print("<pre>");
        $question = Mctesting\Model\Service\QuestionService::getById(1);
        $questiontext = $question->getText();
        print("<h2>Vraag:<br></h2>");
        print_r($questiontext);
        $answers = $question->getAnswers();
        shuffle($answers);
        print("<h2>Antwoorden:<br></h2>");
        print_r($answers);
        print("<br>");









        print("</pre>");
        ?>

    </body>
</html>
