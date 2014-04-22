<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require_once '../src/Mctesting/Model/Service/USerService.php';
            require_once '../src/Mctesting/Model/Data/UserDAO.php';
            require_once '../src/Mctesting/Model/Entity/User.php';
            require_once '../src/Mctesting/Model/Service/TestService.php';
            require_once '../src/Mctesting/Model/Data/TestDAO.php';
            require_once '../src/Mctesting/Model/Entity/Test.php';
            require_once '../src/Mctesting/Model/Entity/FullTest.php';
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
            
            $test = \Mctesting\Model\Service\TestService::getActiveFullTestById(2);
            
            print '<h1>TEST</h1>';
            print '<pre>';
            print_r($test);
            print '</pre>';
        
        ?>
    </body>
</html>
