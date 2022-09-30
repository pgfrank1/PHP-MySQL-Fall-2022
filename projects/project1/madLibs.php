<?php
    // Create the database connection
    $dbc = mysqli_connect('localhost', 'student', 'student', 'MadLibs')
            or die('Error connecting to MySQL server.');

    // Create the database query to select the user made Mad Libs
    $retrieve_stories = "SELECT * FROM wordsAndStories ORDER BY id DESC"; ?>
    <!-- 
    Create the form for the Mad Libs page
    -->
    <title>Mad Libs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <body class="container">
    <form class="form bg-secondary p-4 my-4" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <lable class="form-label" for="noun">Noun</lable>
    <input class="form-control" name="noun"><br>
    <lable  class="form-label">Verb</lable>
    <input class="form-control" name="verb"><br>
    <lable  class="form-label">Adverb</lable>
    <input class="form-control" name="adverb"><br>
    <lable  class="form-label">Adjective</lable>
    <input class="form-control" name="adjective"><br>
    <div class="input-group justify-content-center">
        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
        <button class="btn btn-danger" type="reset" name="reset">Reset</button>
    </div>
    </form> 
    </body>
<?php
    // Attempt to retrieve the user Mad Libs
    $return_stories = mysqli_query($dbc, $retrieve_stories)
        or trigger_error("Error querying database for user stories.",
        E_USER_WARNING);
        // Print out each user Mad Lib onto the webpage
        while($row = mysqli_fetch_assoc($return_stories))
        { ?>
            <div class="" ><p>
            <?php echo $row["completedStory"]; ?>S
            </p></div>
            <?php
        }
 ?>

<?php
    // Print out each user Mad Lib onto the webpage
    while($row = mysqli_fetch_assoc($return_stories))
    { ?>
        <div class="" ><p>
        <?php echo $row["completedStory"]; ?>S
        </p></div>
        <?php
    }

    if (isset($_POST['submit']))
    {   
        $noun = $_POST['noun'];
        $verb = $_POST['verb'];
        $adverb = $_POST['adverb'];
        $adjective = $_POST['adjective'];
        $completed_story = "I like to play $adjective video games $adverb when"
        ." I am relaxing at home. Somtimes, I start to $verb because the game"
        ." has $noun.";

        echo $completed_story;
        
        $query = "INSERT INTO wordsAndStories (noun, verb, adverb, adjective,"
                . " completedStory) VALUES ('$noun', '$verb', '$adverb',"
                . " '$adjective', '$completed_story')";
        
        $result = mysqli_query($dbc, $query)
            or trigger_error('Error querying database.', E_USER_WARNING);

        if (!$result || !$return_stories)
        {
            trigger_error("Query Error description: "
                . mysqli_error($dbc), E_USER_WARNING);
        }
        
        mysqli_close($dbc);
    }
?>