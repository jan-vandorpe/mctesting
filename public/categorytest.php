<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once '../src/Mctesting/Model/Service/CategoryService.php';
        require_once '../src/Mctesting/Model/Data/CategoryDAO.php';
        require_once '../src/Mctesting/Model/Entity/Category.php';
        require_once '../src/Mctesting/Config/Config.php';

            
                /********* Categoriegegevens opvragen **********/
        
        //alle categorieën opvragen
        //$result = \Mctesting\Model\Service\CategoryService::getAll();
        
        //één categorie opvragen
        $result = \Mctesting\Model\Service\CategoryService::getById(2);
        
        //categorie aanmaken
        $test = "test";
        Mctesting\Model\Service\CategoryService::create($test);
        
        print('<pre>');
        print_r($result);
        print('</pre>');
        ?>
    </body>
</html>
