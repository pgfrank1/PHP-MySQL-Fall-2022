<?php
    session_start();
    require_once('page-titles.php');
    require_once('dbconnection.php');
    require_once('the-game-functions.php');
    if (empty($_SESSION['player_name']))
    {
        header('Location: index.php');
    }

    if (empty($_SESSION['player_id']) && empty($_SESSION['player_max_health']))
    {
        $query = "SELECT * FROM Project4.Classes WHERE ClassId = ?";

        $result = parameterizedQuery(DBC, $query, 'i', $_SESSION['player_class'])
            or trigger_error("There was an issue while querying the database", E_USER_ERROR);

        calculateNewPlayerInformation($result);

        $_SESSION['player_current_health'] = $_SESSION['player_max_health'];
        $_SESSION['player_current_mana'] = $_SESSION['player_max_mana'];
        $_SESSION['player_current_stamina'] = $_SESSION['player_max_stamina'];
    }

    $page_title = HOME_PAGE;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title><?= $page_title ?></title>
</head>
<body style="min-height: 100vh !important;">
    <div class="container-fluid row m-0 p-0">
        <div class="d-flex flex-row justify-content-evenly p-0" style="min-height: 70vh!important;">
                <div class="col-4 bg-secondary p-4" style="min-width: 15em !important;">
                    <h1 class="text-center"><?= $_SESSION['player_name']?></h1>
                    <h2 class="text-center"><?= $_SESSION[] ?></h2>
                    <table class="table table-border text-center m-auto w-75">
                        <tr>
                            <th>Health</th>
                        </tr>
                        <tr>
                            <td class="bg-danger"><?= $_SESSION['player_current_health']?>/<?= $_SESSION['player_max_health']?></td>
                        </tr>
                        <tr>
                            <th>Mana</th>
                        </tr>
                        <tr>
                            <td class="bg-primary"><?= $_SESSION['player_current_mana']?>/<?= $_SESSION['player_max_mana']?></td>
                        </tr>
                        <tr>
                            <th>Stamina</th>
                        </tr>
                        <tr>
                            <td class="bg-success"><?= $_SESSION['player_current_stamina']?>/<?= $_SESSION['player_max_stamina']?></td>
                        </tr>
                    </table>
                    <h2 class="text-center pt-4">Attributes</h2>
                    <table class="table text-center m-auto w-50 mb-4">
                        <tr>
                            <th>Strength</th>
                            <th>Perception</th>
                        </tr>
                        <tr>
                            <td><?= $_SESSION['player_strength'] ?></td>
                            <td><?= $_SESSION['player_perception'] ?></td>
                        </tr>
                        <tr>
                            <th>Endurance</th>
                            <th>Charisma</th>
                        </tr>
                        <tr>
                            <td><?= $_SESSION['player_endurance'] ?></td>
                            <td><?= $_SESSION['player_charisma'] ?></td>
                        </tr>
                        <tr>
                            <th>Intelligence</th>
                            <th>Agility</th>
                        </tr>
                        <tr>
                            <td><?= $_SESSION['player_intelligence'] ?></td>
                            <td><?= $_SESSION['player_agility'] ?></td>
                        </tr>
                        <tr>
                            <th colspan="2">Luck</th>
                        </tr>
                        <tr>
                            <td colspan="2"><?= $_SESSION['player_luck'] ?></td>
                        </tr>
                    </table>
                    <a href="save-account.php" class="d-block btn btn-danger">Save Account</a>
                    <br>
                    <?php
                    if (!empty($_SESSION['admin_user_name']))
                    {
                    ?>
                    <a href="admin-page.php" class="d-block btn btn-danger">Go to Admin Page</a>
                    <?php
                    }
                    else
                    {
                    ?>
                    <a href="admin-login.php" class="d-block btn btn-danger">Login to Admin Page</a>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-8 bg-success p-4">
                    dialog
                </div>
        </div>
        <div class="d-flex flex-row justify-content-evenly bg-warning p-0" style="min-height: 30vh!important;">
                <div class="col-4 p-2">
                    <h2 class="text-center">Inventory</h2>
                    <table class="table table-bordered border-light text-center m-auto bg-primary">
                        <tr class="m-auto">
                            <td class="bg-light">1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                    </table>
                </div>
                <div class="col-4 p-2">
                    <h2 class="text-center">Equipment</h2>
                    <table class="table table-bordered border-light text-center m-auto bg-primary">
                        <tr>
                            <td>Equipment</td>
                        </tr>
                    </table>
                </div>
                <div class="col-4 p-2">
                    <h2 class="text-center">Actions</h2>
                    <table class="table table-bordered border-light text-center m-auto bg-primary">
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                        </tr>
                    </table>
                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>
</html>