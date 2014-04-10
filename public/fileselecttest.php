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
            <?php print_r($_POST['media']); ?>
        </pre>
        
        
        <?php
        } else {
            ?>
        
        <form method="post" action="/mctesting/public/fileselecttest.php">
            <input type="file" multiple="true" name="media[]">
            <input type="submit">
        </form>
        <?php
        }
              
        ?>
    </body>
</html>
