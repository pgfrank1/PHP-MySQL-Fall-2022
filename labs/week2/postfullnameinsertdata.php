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
         <?php
         // Grab full name from form
         $first_name = $_POST['first_name'];
         $last_name = $_POST['last_name'];

         // Insert full name into database
        $dbc = mysqli_connect('localhost', 'student', 'student', 'FullName')
            or trigger_error('Error connecting to MySQL server', E_USER_ERROR);
        
        $query = "INSERT INTO fullName (first_name, last_name)"
            . "VALUES ('$first_name', '$last_name')";

        $result = mysqli_query($dbc, $query)
            or trigger_error('Error querying database.', E_USER_WARNING);

        if (!$result) {
            trigger_error("Query Error description: "
                . mysqli_error($dbc), E_USER_WARNING);
        }
        mysqli_close($dbc);
        ?>

        <br><br>Hello <?= $first_name . " " . $last_name; ?>
                Thanks for submitting the form!
        <?php } ?>
</body>
</html>