<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if ($_POST) {
            ?>
        <pre>
            <?php
            //assign post values to variables and print variables
            /*
             * if no files are selected the post value will not be set so testing
             * if it is set is needed
             */
            $text = $_POST['text'];
            $media = (isset($_POST['media'])) ? $_POST['media'] : array() ;
            print ($text);
            print('<br>');
            print_r($media);
            ?>
        </pre>
        
        
        <?php
        } else {
            ?>
        
        <form method="post" action="/mctesting/public/fileselecttest.php">
            <input type="text" name="text">
            <input type="file" multiple="true" name="media[]">
            <input type="submit">
        </form>
        <?php
        }
              
        ?>
    </body>
</html>
