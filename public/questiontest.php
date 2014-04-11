<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
            require_once '../src/Mctesting/Model/Service/MediaService.php';
            require_once '../src/Mctesting/Model/Data/MediaDAO.php';
            require_once '../src/Mctesting/Config/Config.php';
            require_once '../src/Mctesting/Exception/ApplicationException.php';
            
            $question = Mctesting\Model\Service\QuestionService::getById(3);
            
            print '<pre>';
            print_r($question);
            print '</pre>';
        
        ?>
    </body>
</html>
