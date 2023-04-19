<?php
function testOutput()
{
    $test = "a";
    $test2 = "b";
    echo "$test\t$test2"."lol";
    echo `whoami`;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
</head>
<body>
<main>
    <form enctype="multipart/form-data">
        <input type="file">
    </form>
    <?php
    testOutput();
    ?>
</main>
</body>
</html>
