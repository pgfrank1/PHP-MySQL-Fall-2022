<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>
    <?php 
        $path = $_SERVER['PHP_SELF'];
        $page = basename($path);
        switch("$page"):
            case "index.php":
                echo "Project 3 - Home";
            case "createAPost.php":
                echo "Project 2 - Create a Post";
            case "deletePost.php":
                echo "Project 2 - Delete a Post";
        endswitch;
    ?>
    </title>
</head>