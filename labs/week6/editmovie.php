<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <title>Edit A Movie</title>
    </head>
    <body>
        <div class="card">
            <div class="card-body">
                <h1>Edit a Movie</h1>
                <nav class="nav">
                    <a class="nav-link" href="index.php">Movies I Like</a>
                </nav>
                <hr/>
                <?php
                require_once('dbconnection.php');

                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                        or trigger_error('Error connecting to movieListing.', E_USER_ERROR);
                    
                $genres = [
                    'Action', 'Adventure', 'Comedy', 'Documentary', 'Drama',
                    'Fantasy', 'Horror', 'Medival', 'Romance', 'Science Fiction'
                ];

                if (isset($_GET['id_to_edit'])):
                    $id_to_edit = $_GET['id_to_edit'];

                    $query = "SELECT * FROM movieListing WHERE id = $id_to_edit";

                    $result = mysqli_query($dbc, $query)
                        or trigger_error('Error querying movieListing', E_USER_ERROR);
                    if(mysqli_num_rows($result) == 1):
                        $row = mysqli_fetch_assoc($result);

                        $movie_title = $_POST['movie_title'];
                        $movie_rating = $_POST['movie_rating'];
                        $movie_director = $_POST['movie_director'];
                        $movie_release_year = $_POST['movie_release_year'];
                        $movie_runtime = $_POST['movie_running_time_in_minutes'];
                        $checked_movie_genres = $_POST['movie_genre_checkbox'];
                        $id_to_edit = $_POST['id_to_edit'];

                        $checked_movie_genres = explode(', ', $movie_genre_text);
                    endif;
                elseif (isset($_POST['edit_movie_submission'], $_POST['movie_title'],
                        $_POST['movie_rating'], $_POST['movie_director'],
                        $_POST['movie_running_time_in_minutes'])):
                    $movie_title = $_POST['movie_title'];
                    $movie_rating = $_POST['movie_rating'];
                    $movie_director = $_POST['movie_director'];
                    $movie_release_year = $_POST['movie_release_year'];
                    $movie_runtime = $_POST['movie_running_time_in_minutes'];
                    $checked_movie_genres = $_POST['movie_genre_checkbox'];

                    $movie_genre_text = "";

                    if (isset($checked_movie_genres)):
                        $movie_genre_text = implode(", ", $checked_movie_genres);
                    endif;
                    
                    $query = "UPDATE movieListing SET title = '$movie_title', rating = '$movie_rating',"
                            . "director = '$movie_director', release_year = '$movie_release_year',"
                            . "running_time_in_minutes = '$running_time_in_minutes',"
                            . "genre = '$genre' WHERE id = $id_to_edit";
                    mysqli_query($dbc, $query)
                            or trigger_error('Error modifying database', E_USER_ERROR);
                    $nav_link = 'moviedetails.php?id=' . $id_to_edit;

                    header("Location: $nav_link");
                    exit;
                else:
                    header("Location; index.php");
                    exit;
                endif;
                ?>
                <form class="needs-validation" novalidate method="POST"
                        action="<?= $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group row">
                        <label for="movie_title" class="col-sm-3 col-form-label-lg">
                                Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="movie_title"
                                    name="movie_title" placeholder="Title"
                                    value="<?= $movie_title?>" required>
                            <div class="invalid-feedback">
                                Please provide a valid movie title.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="movie_rating" class="col-sm-3 col-form-label-lg">
                                Rating</label>
                        <div class="col-sm-8">
                            <select class="custom-select" id="movie_rating" name="movie_rating"
                                    value="<?= $movie_rating?>" required>
                                <option value="" disabled selected>Rating...</option>
                                <option value="G">G</option>
                                <option value="PG">PG</option>
                                <option value="PG-13">PG-13</option>
                                <option value="R">R</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a movie rating.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="movie_director" class="col-sm-3 col-form-label-lg">
                                Director</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="movie_director"
                                    name="movie_director" placeholder="Director"
                                    value="<?= $movie_director ?>" required>
                            <div class="invalid-feedback">
                                Please provide a valid movie director.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="movie_release_year" class="col-sm-3 col-form-label-lg">
                                Release Year</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="movie_release_year"
                                    name="movie_release_year" placeholder="Release Year"
                                    value="<?= $movie_release_year ?>" required>
                            <div class="invalid-feedback">
                                Please enter a valid release year.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="movie_running_time_in_minutes" class="col-sm-3 col-form-label-lg">
                                Running Time (min)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="movie_running_time_in_minutes"
                                    name="movie_running_time_in_minutes" placeholder="Running time (in minutes)" required>
                            <div class="invalid-feedback">
                                Please provide a valid running time in minutes.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label-lg">Genre</label>
                        <div class="col-sm-8">
                            <?php 
                                foreach ($genres as $genre)
                                {
                            ?>
                                    <div class="form-check form-check-inline col-sm-3">
                                        <input class="form-check-input" type="checkbox" id="movie_genre_checkbox_action"
                                                name="movie_genre_checkbox[]" value="<?= $genre ?>">
                                        <label class="form-check-label" for="movie_genre_checkbox_action"><?= $genre ?></label>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" name="add_movie_submission">Add Movie</button>
                </form>
            </div>
            <script>
                (function() {
                    'use strict';
                    window.addEventListener('load', function() {
                        var forms = document.getElementsByClassName('needs-validation');
                        var validation = Array.prototype.filter.call(forms, function(form) {
                            form.addEventListener('submit', function(event) {
                                if (form.checkValidity() == false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }
                                form.classList.add('was-validated');
                            }, false);
                        });
                    }, false);
                })();
            </script>
            </div>
        </div>
    </body>

