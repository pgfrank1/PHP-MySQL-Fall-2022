<?php
if(isset($_POST['submit']))
{
?>
<ol>
    <li>Email: <?php echo $_POST['email_address']?> </li>
    <li>Password: <?php echo $_POST['password']?></li>
    <li>City: <?php echo $_POST['city']?></li>
    <li>State: <?php echo $_POST['state']?></li>
    <li>Zip: <?php echo $_POST['zip']?></li>
    <li><?php echo $_POST['email_offer']?></li>
    <li><?php echo $_POST['terms_and_conditions']?></li>
</ol>
<?php
}
else
{
    header('Location: newUser.html');
}