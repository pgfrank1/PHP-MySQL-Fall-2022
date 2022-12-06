<?php
session_start();
require_once('page-titles.php');
require_once('admin-page-functions.php');
$page_title = ADMIN_PAGE;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="./css/normalize.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
<?php
require_once("dbconnection.php");
require_once("query-utils.php");
?>
<main>
    <div class="container-fluid">
        <h1 class="text-center">Admin Control</h1>
        <div class="d-flex justify-content-center">
                <form class="needs-validation bg-light w-75 p-4 m-1" novalidate method="post" action="<?= $_SERVER['PHP_SELF']?>">
                    <h2 class="text-center mb-4">Create New Admin</h2>
                    <div class="form-group text-center">
                        <label class="form-label" for="admin_username">Admin Username:</label>
                        <input class="form-control" type="text" name="admin_username" id="admin_username" placeholder="Username" required>
                        <div class="invalid-feedback">
                            Please provide the new Username.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="admin_password">Admin Password:</label>
                        <input class="form-control" type="password" name="admin_password" id="admin_password" placeholder="Password" required>
                        <div class="invalid-feedback">
                            Please provide the password.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="verify_admin_password">Verify Admin Password:</label>
                        <input class="form-control" type="password" name="verify_admin_password" id="verify_admin_password" placeholder="Password" required>
                        <div class="invalid-feedback">
                            Please verify the password.
                        </div>
                    </div>
                    <div class="pt-4 text-center align-self-end">
                        <button class="btn btn-primary" type="submit" name="create_admin">Submit</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                    <?php
                    if (isset($_POST['create_admin']))
                    {
                        $username = $_POST['admin_username'];
                        $password = $_POST['admin_password'];
                        $verify_password = $_POST['verify_admin_password'];

                        echo createAdminUser($username, $password, $verify_password);
                    }
                    ?>
                </form>
                <form class="needs-validation bg-light w-75 p-4 m-1" novalidate method="POST" action="<?= $_SERVER['PHP_SELF']?>">
                    <h2 class="text-center mb-4">Create New Item</h2>
                    <div class="form-group text-center">
                        <label class="form-label" for="item_name">Item Name:</label>
                        <input class="form-control" type="text" name="item_name" id="item_name" placeholder="Item Name" required>
                        <div class="invalid-feedback">
                            Please provide the Item Name.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="item_description">Item Description:</label>
                        <input class="form-control" type="text" name="item_description" id="item_description" placeholder="Item Description" required>
                        <div class="invalid-feedback">
                            Please provide the Item Description.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="item_value">Item Value:</label>
                        <input class="form-control" type="number" name="item_value" id="item_value" placeholder="Item Value" required>
                        <div class="invalid-feedback">
                            Please provide the Item Value.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="item_defence">Item Defence:</label>
                        <input class="form-control" type="number" name="item_defence" id="item_defence" placeholder="Item Defence" required>
                        <div class="invalid-feedback">
                            Please provide the Item Defence.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="item_attack_strength">Item Attack Strength:</label>
                        <input class="form-control" type="number" name="item_attack_strength" id="item_attack_strength" placeholder="Item Attack Strength" required>
                        <div class="invalid-feedback">
                            Please provide the Item Attack Strength.
                        </div>
                    </div>
                    <div class="pt-4 text-center">
                        <button class="btn btn-primary" type="submit" name="create_item">Submit</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                    <?php
                    if (isset($_POST['create_item']))
                    {
                        $item_name = $_POST['item_name'];
                        $item_description = $_POST['item_description'];
                        $item_value = $_POST['item_value'];
                        $item_defence = $_POST['item_defence'];
                        $item_attack_strength = $_POST['item_attack_strength'];

                        echo createNewItem($item_name, $item_description, $item_value, $item_defence, $item_attack_strength);
                    }
                    ?>
                </form>
        </div>
    </div>
</main>
<!-- Input Validation Script -->
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            let forms = document.getElementsByClassName('needs-validation');
            let validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

