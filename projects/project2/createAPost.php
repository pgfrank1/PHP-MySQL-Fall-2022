<!DOCTYPE html>
<html lang="en">
<?php
include('head.php');
?>
<body>
    <div class="container">
        <div class="row">
        <?php
        include('nav.php');
        
        if (!isset($_POST['add_post']))
        {
        ?>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Create a post</h3>
                    <form class="needs-validation" novalidate method="POST"
                        action="<?= $_SERVER['PHP_SELF']?>">
                        <div class="form-group row">
                            <label for="post_title" class="col-sm-3 col-form-label-lg">
                                    Title</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="post_title"
                                        name="post_title" placeholder="Title" required>
                                <div class="invalid-feedback">
                                    Please provide a title.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="post_content" class="col-sm-3 col-form-label-lg">
                                    Post</label>
                            <div class="col-sm-8">
                                <input type="textarea" class="form-control" id="post_content"
                                        name="post_content" placeholder="Enter your post here" required>
                                <div class="invalid-feedback">
                                    Please provide your post.
                                </div>
                            </div>
                        </div>
                        <div class="py-4">
                            <button  class="btn btn-primary" type="submit" name="add_post">Submit</button>
                            <button  class="btn btn-danger" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
        if (isset($_POST['add_post']))
        {
            $user_title = $_POST['post_title'];
            $user_content = $_POST['post_content'];
        ?>
        <h2 class="text-center p-2">Would you like to add this post?</h2>
        <form method="post">
            <div class="card  m-1 p-0">
                    <div class="card-header row mx-0">
                        <div class="col-11">
                            <?= $user_title ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>
                            <?= $user_content ?>
                        </p>
                        <div class="fs-6 fst-italic text-muted text-end">
                            <?php
                            echo date('D M d Y H:i:s');
                            ?>
                        </div>
                    </div>
                </div>
                <span hidden>
                    <input type="text" value="<?=$user_title?>" name="user_title">
                    <input type="text" value="<?=$user_content?>" name="user_content">
                </span>
                <div class="text-center p-2">
                    <button class="btn btn-primary" type="submit" name="save_post">Add</button>
                    <a href="#"><button class="btn btn-secondary">Go back</button></a>
                </div>    
        </form>
            
        <?php
        }
        if (isset($_POST['save_post']))
        {
            require_once('dbconnection.php');

            $user_title = $_POST['user_title'];
            $user_title = str_replace("'", "''", $user_title);

            $user_content = $_POST['user_content'];
            $user_content = str_replace("'", "''", $user_content);

            $post_date = date('Y-m-d h:i:s');

            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);

            $query = "INSERT INTO BlogPosts (title, post, date_posted) VALUES ('$user_title', '$user_content', '$post_date')";

            mysqli_query($dbc, $query)
                or trigger_error(
                    'Error querying database BlogPosts: Failed to insert post',
                    E_USER_ERROR
                );

            header("Location: index.php");
        }
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f90e67e55f.js" crossorigin="anonymous"></script>
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
</body>
</html>
<?php
function showPost()
{
    global $user_title, $user_content;

    
}
?>