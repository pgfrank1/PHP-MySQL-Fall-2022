<?php
    /**
     * Exercise 1) Create an array to hold a list of at least five book titles.
     * Echo the tiles of the thrird and fourth books.
     */
    $listOfBooks = ["Harry Potter", "Holes", "Ready Player One", "Game of Thrones", "The Hobbit"];
    echo $listOfBooks[2] . ", " . $listOfBooks[3];

    /**
     * Exercise 2) Create an associative array to hold a list of at least three book titles and 
     * their authors. Use book titles as the keys. Output the title and author of each book on a new line.
     */
    $authorOfBooks = [
        "Harry Potter" => "J.K. Rowling",
        "The Hobbit" => "J.R.R. Tolkien",
        "Holes" => "Louis Sachar"
    ];
    echo "<br><br>";
    foreach ($authorOfBooks as $author) {
        echo array_search($author, $authorOfBooks) . ": " . $author . "<br>";
    }

    /**
     * Exercise 3) Append another book and author to the list of books abouve. Use print_r()
     * to see the array's structure.
     */
    echo "<br>";
    array_push($authorOfBooks, ["Ready Player One" => "Ernest Cline"]);
    print_r($authorOfBooks);

    /**
     * Exercise 4) Output how many book are in your list of books.
     */
    echo "<br><br>";
    echo count($authorOfBooks);
    /**
     * Use asort() to sort your books by title. Use print_r() to confirm the array is sorted correctly.
     */
    echo "<br><br>";
    ksort($authorOfBooks);
    print_r($authorOfBooks);
?>