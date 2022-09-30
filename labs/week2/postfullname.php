<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form for Entering Full Name</title>
</head>
<body>
    <?php if (!isset($_POST['submit'])) { ?>
        <h2>Enter Full Name</h2>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            First name: <br>
            <input name="first_name"><br>
            Last name: <br>
            <input name="last_name"><br>
            <p>
            <input type="submit" name="submit" value="Submit Name" />
        </form>
    <?php } else { ?>
         <h2>Greetings!</h2>
         Hello <?= $_POST['first_name'] . " " . $_POST['last_name'] ?>
         , thanks for submitting the form!
    <?php } ?>
</body>
</html>