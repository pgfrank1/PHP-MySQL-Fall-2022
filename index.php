<!DOCTYPE html>
<html>
  <head>
    <title>PHP Fall 2022 Home Page</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class='container'>
      <div class='page-header'>
        <h1>This is my PHP Fall 2022 Home Page</h1>
      </div>
      <div class='well'>
        <h3 class='text-danger'>Wow! If you got here, that means Apache is running. Yay!</h3>
      </div>
	  <div class="alert alert-info" role="alert">
		<!--<h4><a href='test.php' class='text-info'>Testing PHP</a></h4>-->
		<h4>Testing PHP</h4>
		<?php
		date_default_timezone_set('America/Chicago');
		echo "<hr>";
        echo "<h3>Today is: " . date('l \t\h\e jS \of F Y') . "</h3>";
        echo "<h3>The time is: " . date('h:i:s A') . "</h3><br/>";
		?>
	  </div>
	  <div class="alert alert-success" role="alert">
		<h4><a href='http://localhost/adminer/?server=localhost&username=student' class='text-success'>Adminer</a></h4>
	  </div>
    </div>
  </body>
 </html>
