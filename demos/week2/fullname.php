<html>
<head>
  <title>Full Name</title>
</head>
<body>
  <h2>Full Name</h2>

<?php
    $first_name = $_POST['firstname'];
    $last_name  = $_POST['lastname'];

    echo "Hi " . $first_name . " " . $last_name . ". Thanks for submitting the form!";
?>
</body>
</html>
