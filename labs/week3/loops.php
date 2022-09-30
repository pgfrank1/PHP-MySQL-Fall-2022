<?php 
    /**
     * Exercise 1) Write a loop to count from one to ten and output each value in one column. In a second column,
     * output the square of the number.
     */
    for ($i = 1; $i <= 10; $i++) {
        echo "<br>$i / " . $i * $i;
    }
    echo "<br><br>";
     /**
      * Exercise 2) Use a foreach loop to output your list of book titles from arrays.php in Chapter 6
      */
    $listOfBooks = ["Harry Potter", "Holes", "Ready Player One",
            "Game of Thrones", "The Hobbit"];
    foreach ($listOfBooks as $book) {
        echo "$book<br>";
    }
?>