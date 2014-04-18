<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once '../src/Mctesting/Model/Service/CategoryService.php';
        require_once '../src/Mctesting/Model/Service/SubcategoryService.php';
        require_once '../src/Mctesting/Model/Data/CategoryDAO.php';
        require_once '../src/Mctesting/Model/Data/SubcategoryDAO.php';
        require_once '../src/Mctesting/Model/Entity/Category.php';
        require_once '../src/Mctesting/Model/Entity/Subcategory.php';
        require_once '../src/Mctesting/Config/Config.php';
        require_once '../src/Mctesting/Exception/ApplicationException.php';
        

        /* Subcategoriegegevens opvragen */
        
        
        
        
        //activeren en deactiveren subcategorie
                \Mctesting\Model\Service\SubcategoryService::deactivateSubcategory(7);
                \Mctesting\Model\Service\CategoryService::deactivateCategory(7);

        //individuele subcategorieën hebben zowel categorie- als subcategorieid nodig
        $result = \Mctesting\Model\Service\SubcategoryService::getById(7);
              
        //alle subcategorieën
//        $result = \Mctesting\Model\Service\SubcategoryService::getAll(); 
              
//        alle subcategorieën voor één categorie
//        $result = \Mctesting\Model\Service\SubcategoryService::getByCategoryId(4);

        //nieuwe subcategorie aanmaken
//        $catid = 4;
//        $subcatid = 2;
//        $subcatnaam = "testsubcategorie2";
//        Mctesting\Model\Service\SubcategoryService::create($catid,$subcatid,$subcatnaam);
        
        print('<pre>');
        print_r($result);
        print('</pre>');
        ?>
    </body>
</html>
