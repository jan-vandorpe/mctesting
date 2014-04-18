<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
              require_once '../src/Mctesting/Model/Service/TestSessionService.php';
              require_once '../src/Mctesting/Model/Data/TestSessionDAO.php';
              require_once '../src/Mctesting/Model/Entity/TestSession.php';
              require_once '../src/Mctesting/Config/Config.php';
              require_once '../src/Mctesting/Exception/ApplicationException.php';
              
              try {
                $sessions = Mctesting\Model\Service\TestSessionService::getSessionsByTest(1);
                  
                  
                print('<pre>');
                print_r($sessions);
                print('</pre>');  
                
                foreach ($sessions as $session) {
                    if ($session->getActive()) {
                        print 'sessieid: '.$session->getId().' ==> ACTIEF<br>';
                    } else {
                        print 'sessieid: '.$session->getId().' ==> NIET ACTIEF<br>';
                    }
                }
                
              } catch (\Mctesting\Exception\ApplicationException $ex) {
                  printf($ex->getMessage()) ;
              }
              
              
              
              
        ?>
    </body>
</html>
