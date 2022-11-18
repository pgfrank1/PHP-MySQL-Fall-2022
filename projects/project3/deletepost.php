<?php
    //require_once('authorize.php');
    session_start();
    require_once('pagetitles.php');
    $page_title = DELETE_POST;
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php');
    }
?>
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

        $id = $_GET['id_to_delete'];

        if (isset($_POST['delete_post']))
        {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);

            $query = "DELETE FROM BlogPosts WHERE id = $id";

            $result = mysqli_query($dbc, $query)
                or trigger_error(
                    'Error querying database BlogPosts: Failed to delete post',
                    E_USER_ERROR
                );
            header('Location: index.php');
            exit;
        }
        else
        {
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
                        action="">
                <div class="py-3 text-center">
                    <button class="btn btn-danger" name="delete_post" type="submit" method="POST"
                        action="">Delete Post</button>
                    <button class="btn btn-primary">Go Back</button>
                </div></form>
            </div> 
            <?php
            }
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f90e67e55f.js" crossorigin="anonymous"></script>
</body>
</html>