<html>
    <head>
        <title>Personalized Hello World</title>
    </head>
    <body>
        <?php
            if(!empty($_POST['name'])) {
                echo "Greetings, {$_POST['name']}, and welcome.";
            }
        ?>
    </body>
    <form action="<?php $PHP_SELF; ?>" method="POST">
            Enter your name: <input type="text" name="name" />
            <input type="submit">
    </form>
</html>