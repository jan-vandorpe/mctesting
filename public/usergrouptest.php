<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
              require_once '../src/Mctesting/Model/Service/UsergroupService.php';
              require_once '../src/Mctesting/Model/Data/UsergroupDAO.php';
              require_once '../src/Mctesting/Model/Entity/Usergroup.php';
              require_once '../src/Mctesting/Config/Config.php';
              
              $result = \Mctesting\Model\Service\UsergroupService::getAll();
              print('<pre>');
              print_r($result);
              print('</pre>');  
        ?>
    </body>
</html>
