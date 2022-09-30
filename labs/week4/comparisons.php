<?php

/**
 * Exercise 1)
 * Use $x = random_int(1,10) to pick a number between 1 and 10.
 * Output the value of $x. Then indicate if it is between 3 and 7 inclusive.
 */

 $x = random_int(1,10);
 echo $x;
 if ($x >= 3 && $x <= 7)
 {
    echo " is between or equal to 3 and 7.";
 }
?>
<br><br>
<?php
 /**
  * Exercise 2)
  * Use $x = random_int(1,10) to pick a number between 1 and 10.
  * Output the value of $x. Indicate if it's less than 3, between 3 and 7 inclusive,
  * or greater than 7.
  */
  $x = random_int(1,10);
  echo $x;
  
  if ($x < 3)
  {
   echo " is less than 3.";
  }
  if ($x >= 3 && $x <= 7)
  {
   echo " is between 3 and 7.";
  }
  if ($x > 7)
  {
   echo " is more than 7.";
  }
?>
<br><br>
<?php

  /**
   * Exercise 3)
   * Redo the previous exercise using compound conditional statements.
   */
  $x = random_int(1,10);
  echo $x;
  
  if ($x < 3)
  {
   echo " is less than 3.";
  }
  elseif ($x >= 3 && $x <= 7)
  {
   echo " is between 3 and 7.";
  }
  else
  {
   echo " is more than 7.";
  }
?>