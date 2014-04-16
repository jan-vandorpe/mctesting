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
              require_once '../src/Mctesting/Config/Config.php';
              require_once '../src/Mctesting/Exception/ApplicationException.php';
              
              
              $newAnswer = new Mctesting\Model\Entity\Answer();
              $newAnswer->setId(99);
              $newAnswer->setQuestionId(5);
              $newAnswer->setText('Testantwoord');
              
              

              
              try {
//                  $answer = Mctesting\Model\Service\AnswerService::getSingleByQuestionAndId(5, 99);
//                  \Mctesting\Model\Data\AnswerDAO::insert($newAnswer);
//                  $result = Mctesting\Model\Service\AnswerService::getByQuestion(3);
//                  var_dump($newAnswer);
              } catch (\Mctesting\Exception\ApplicationException $ex) {
                  printf($ex->getMessage()) ;
              }
              
              
              
              print('<pre>');
//              print_r($result);
//              print_r($newAnswer);
              print_r($newAnswer);
              print('</pre>');  
        ?>
    </body>
</html>
