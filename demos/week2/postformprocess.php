<html>
 <head>
  <title>Process Form using POST</title>
 </head>
 <body bgcolor = "lightgreen"><font size="+1">
  <h2>Here is the form input:</h2>
  <?php    
    $name = $_POST['your_name'];
    $phone = $_POST['your_phone'];
    $email = $_POST['your_email_addr'];

    print "Welcome to PHP $name!<br />";
    print "Can I call you at $phone?<br />";
    print "Is it ok to send you email at $email?<br />";
  ?>
 </body>
</html>
