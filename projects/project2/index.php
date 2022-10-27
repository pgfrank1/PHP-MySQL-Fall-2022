<!DOCTYPE html>
<?php 
    include('head.php');
?>
<body>
    <div class="container">
        <?php 
            include('nav.php');
        ?>
        <div class="row m-0 p-0">
<?php

    require_once("dbconnection.php");

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);

    $query = "SELECT * FROM BlogPosts ORDER BY id DESC";

    $result = mysqli_query($dbc, $query)
        or trigger_error("There was an issue while querying the database", E_USER_ERROR);

    if (mysqli_num_rows($result)):
        while ($row = mysqli_fetch_assoc($result))
        {
        ?>
            <div class="card  m-1 p-0">
                <div class="card-header row mx-0">
                    <div class="col">
                        <?=$row["title"] ?>
                    </div>
                    <?php
                    //if ()
                    ?>
                    <a class="col-1" href="deletePost.php?id_to_delete=<?=$row["id"]?>"><i class="fa-sharp fa-solid fa-trash"></i></a>
                </div>
                <div class="card-body">
                    <p>
                        <?=$row["post"]?>
                    </p>
                    <div class="fs-6 fst-italic text-muted text-end">
                        <?php
                        $time = $row['date_posted'];
                        $date = strtotime(($time));
                        echo date('D M d Y h:i:s', $date);
                        ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/f90e67e55f.js" crossorigin="anonymous"></script>
        </body>
        </html>
    <?php
    endif;
?>
