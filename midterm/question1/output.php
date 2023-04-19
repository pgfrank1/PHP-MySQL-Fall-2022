<?php
if(isset($_POST['submit']))
{
?>
    <li><?php echo $_POST['email']?></li>
    <li><?php echo $_POST['password']?></li>
    <li><?php echo $_POST['remember_me']?></li>
<?php
}
else
{
    header("Location: form.html");
}
