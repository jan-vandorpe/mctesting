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
            require_once '../src/Mctesting/Model/Service/CategoryService.php';
            require_once '../src/Mctesting/Model/Data/CategoryDAO.php';
            require_once '../src/Mctesting/Model/Entity/Category.php';
            require_once '../src/Mctesting/Model/Service/MediaService.php';
            require_once '../src/Mctesting/Model/Data/MediaDAO.php';
            require_once '../src/Mctesting/Config/Config.php';
            require_once '../src/Mctesting/Exception/ApplicationException.php';
            
            $questions = Mctesting\Model\Service\QuestionService::getByCategory(2);
            $activeQuestions = \Mctesting\Model\Service\QuestionService::getActiveByCategory(2);
            
            print '<h1>ALL QUESTIONS</h1>';
            print '<pre>';
            print_r($questions);
            print '</pre>';
            print '<h1>ACTIVE QUESTIONS ONLY</h1>';
            print '<pre>';
            print_r($activeQuestions);
            print '</pre>';
        
        ?>
    </body>
</html>
