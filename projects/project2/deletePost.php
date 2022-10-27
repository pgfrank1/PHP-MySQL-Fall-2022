<!DOCTYPE html>
<html lang="en">
<?php  
    include('head.php');
?>
<body>
    <div class="container">
    <?php 
        require_once("dbconnection.php");

        include('nav.php');

        if (isset($_POST['authenticated']))
        {
            $entered_password = $_POST['admin_password'];
            
            if ($entered_password == ADMIN_PASS)
            {
                echo $entered_password. " Password check works";
                require_once("dbconnection.php");
                

            }
            else
            {
                echo $entered_password . " Password check failed.";
            }
            exit();
        }
        if (!isset($_POST['delete_post']))
        {
            $id = $_GET['id_to_delete'];

            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);

            $query = "SELECT * FROM BlogPosts WHERE id = $id";

            $result = mysqli_query($dbc, $query)
                or trigger_error(
                    'Error querying database BlogPosts: Failed to insert post',
                    E_USER_ERROR
                );

            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                ?>
                <h3 class="p-1 text-center">Delete this post?</h3>
                <div class="card  m-1 p-0">
                    <div class="card-header row mx-0">
                        <div class="col">
                            <?= $row["title"] ?>
                        </div>
                    </div>
                    <div class="card-body">
                    <p>
                        <?=$row["post"]?>
                    </p>
                    </div>
                    <div class="fs-6 p-2 fst-italic text-muted text-end">
                        <?php
                        $time = $row['date_posted'];
                        $date = strtotime(($time));
                        echo date('D M d Y h:i:s A', $date);
                        ?>
                    </div>
                </div>
                <form class="needs-validation" novalidate method="POST"
                        action="<?= $_SERVER['PHP_SELF']?>">
                <div class="py-3 text-center">
                    <button class="btn btn-danger" name="delete_post" type="submit" method="POST"
                        action="<?= $_SERVER['PHP_SELF']?>">Delete Post</button>
                    <a href="index.php"><button class="btn btn-primary">Go Back</button></a>
                </div></form>
            </div> 
            <?php
            }
        }
        else
        {
            ?>
            <div>
                <form class="needs-validation" action="<?= $_SERVER['PHP_SELF']?>" method="post">
                    <label for="admin_password">Please enter admin password to delete</label>
                    <input type="password" class="form-control" id="admin_password" name="admin_password" placeholder="Password" required>
                    <div class="invalid-feedback">Please provide the admin password.</div>
                    <div class="py-4 text-center">
                        <button  class="btn btn-primary" type="submit" name="authenticated">Submit</button>
                    </div>
                </form>
            </div>
            <?php
            
        }
        ?>
    </div>
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