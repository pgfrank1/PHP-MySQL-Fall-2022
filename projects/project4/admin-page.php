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
    <div class="container">
        <h1 class="text-center">Admin Control</h1>
        <div class="row row-cols-3 p-0">
            <form class="needs-validation bg-light p-4 col-6 col-md-4 my-1 border border-secondary h-100" novalidate method="post" action="<?= $_SERVER['PHP_SELF']?>">
                <h2 class="text-center mb-4 h-25">Create New Admin</h2>
                <div class="h-75">
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
            <form class="needs-validation bg-light p-4 col-6 col-md-4 my-1 border border-secondary h-100" novalidate method="POST" action="<?= $_SERVER['PHP_SELF']?>">
                <h2 class="text-center mb-4 h-25">Create New Item</h2>
                <div class="h-75">
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
            <form class="needs-validation bg-light p-4 col-6 col-md-4 my-1 border border-secondary h-100" novalidate method="POST" action="<?= $_SERVER['PHP_SELF']?>">
                <h2 class="text-center mb-4 h-25">Create New Consumable</h2>
                <div class="h-75">
                    <div class="form-group text-center">
                        <label class="form-label" for="consumable_name">Consumable Name:</label>
                        <input class="form-control" type="text" name="consumable_name" id="consumable_name" placeholder="Consumable Name" required>
                        <div class="invalid-feedback">
                            Please provide the Consumable Name.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="consumable_description">Consumable Description:</label>
                        <input class="form-control" type="text" name="consumable_description" id="consumable_description" placeholder="Consumable Description" required>
                        <div class="invalid-feedback">
                            Please provide the Consumable Description.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="consumable_value">Consumable Value:</label>
                        <input class="form-control" type="number" name="consumable_value" id="consumable_value" placeholder="Consumable Value" required>
                        <div class="invalid-feedback">
                            Please provide the Consumable Value.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="health_recovery">Health Recovery:</label>
                        <input class="form-control" type="number" name="health_recovery" id="health_recovery" placeholder="Health Recovery" required>
                        <div class="invalid-feedback">
                            Please provide the Health Recovery.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="stamina_recovery">Stamina Recovery:</label>
                        <input class="form-control" type="number" name="stamina_recovery" id="stamina_recovery" placeholder="Stamina Recovery" required>
                        <div class="invalid-feedback">
                            Please provide the Stamina Recovery.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="mana_recovery">Mana Recovery:</label>
                        <input class="form-control" type="number" name="mana_recovery" id="mana_recovery" placeholder="Mana Recovery" required>
                        <div class="invalid-feedback">
                            Please provide the Mana Recovery.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="strength_boost">Strength Boost:</label>
                        <input class="form-control" type="number" name="strength_boost" id="strength_boost" placeholder="Strength Boost" required>
                        <div class="invalid-feedback">
                            Please provide the Strength Boost.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="perception_boost">Perception Boost:</label>
                        <input class="form-control" type="number" name="perception_boost" id="perception_boost" placeholder="Perception Boost" required>
                        <div class="invalid-feedback">
                            Please provide the Perception Boost.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="endurance_boost">Endurance Boost:</label>
                        <input class="form-control" type="number" name="endurance_boost" id="endurance_boost" placeholder="Endurance Boost" required>
                        <div class="invalid-feedback">
                            Please provide the Endurance Boost.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="charisma_boost">Charisma Boost:</label>
                        <input class="form-control" type="number" name="charisma_boost" id="charisma_boost" placeholder="Charisma Boost" required>
                        <div class="invalid-feedback">
                            Please provide the Charisma Boost.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="intelligence_boost">Intelligence Boost:</label>
                        <input class="form-control" type="number" name="intelligence_boost" id="intelligence_boost" placeholder="Intelligence Boost" required>
                        <div class="invalid-feedback">
                            Please provide the Intelligence Boost.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="agility_boost">Agility Boost:</label>
                        <input class="form-control" type="number" name="agility_boost" id="agility_boost" placeholder="Agility Boost" required>
                        <div class="invalid-feedback">
                            Please provide the Agility Boost.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="luck_boost">Luck Boost:</label>
                        <input class="form-control" type="number" name="luck_boost" id="luck_boost" placeholder="Luck Boost" required>
                        <div class="invalid-feedback">
                            Please provide the Luck Boost.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="duration">Duration:</label>
                        <input class="form-control" type="number" name="duration" id="duration" placeholder="Duration" required>
                        <div class="invalid-feedback">
                            Please provide the Duration.
                        </div>
                    </div>
                    <div class="pt-4 text-center">
                        <button class="btn btn-primary" type="submit" name="create_consumable">Submit</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                </div>
                <?php
                if (isset($_POST['create_consumable']))
                {
                    $consumable_name = $_POST['consumable_name'];
                    $consumable_description = $_POST['consumable_description'];
                    $consumable_value = $_POST['consumable_value'];
                    $health_recovery = $_POST['health_recovery'];
                    $stamina_recovery = $_POST['stamina_recovery'];
                    $mana_recovery = $_POST['mana_recovery'];
                    $strength_boost = $_POST['strength_boost'];
                    $perception_boost = $_POST['perception_boost'];
                    $endurance_boost = $_POST['endurance_boost'];
                    $charisma_boost = $_POST['charisma_boost'];
                    $intelligence_boost = $_POST['intelligence_boost'];
                    $agility_boost = $_POST['agility_boost'];
                    $luck_boost = $_POST['luck_boost'];
                    $duration = $_POST['duration'];

                    echo createNewConsumable($consumable_name, $consumable_description, $consumable_value , $health_recovery,
                            $stamina_recovery, $mana_recovery, $strength_boost, $perception_boost, $endurance_boost, $charisma_boost,
                            $intelligence_boost, $agility_boost, $luck_boost, $duration);
                }
                ?>
            </form>
            <form class="needs-validation bg-light p-4 col-6 col-md-4 my-1 border border-secondary h-100" novalidate method="POST" action="<?= $_SERVER['PHP_SELF']?>">
                <h2 class="text-center mb-4 h-25">Create New Enemy</h2>
                <div class="h-75">
                    <div class="form-group text-center">
                        <label class="form-label" for="enemy_name">Enemy Name:</label>
                        <input class="form-control" type="text" name="enemy_name" id="enemy_name" placeholder="Enemy Name" required>
                        <div class="invalid-feedback">
                            Please provide the Item Name.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="enemy_health">Enemy Health:</label>
                        <input class="form-control" type="number" name="enemy_health" id="enemy_health" placeholder="Enemy Health" required>
                        <div class="invalid-feedback">
                            Please provide the Item Description.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="experience">Experience:</label>
                        <input class="form-control" type="number" name="experience" id="experience" placeholder="Experience" required>
                        <div class="invalid-feedback">
                            Please provide the Item Value.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="strength">Strength:</label>
                        <input class="form-control" type="number" name="strength" id="strength" placeholder="Strength" required>
                        <div class="invalid-feedback">
                            Please provide the Item Defence.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="perception">Perception:</label>
                        <input class="form-control" type="number" name="perception" id="perception" placeholder="Perception" required>
                        <div class="invalid-feedback">
                            Please provide the Item Attack Strength.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="endurance">Endurance:</label>
                        <input class="form-control" type="number" name="endurance" id="endurance" placeholder="Endurance" required>
                        <div class="invalid-feedback">
                            Please provide the Item Attack Strength.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="charisma">Charisma:</label>
                        <input class="form-control" type="number" name="charisma" id="charisma" placeholder="Charisma" required>
                        <div class="invalid-feedback">
                            Please provide the Item Attack Strength.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="intelligence">Intelligence:</label>
                        <input class="form-control" type="number" name="intelligence" id="intelligence" placeholder="Intelligenceh" required>
                        <div class="invalid-feedback">
                            Please provide the Item Attack Strength.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="agility">Agility:</label>
                        <input class="form-control" type="number" name="agility" id="agility" placeholder="Agility" required>
                        <div class="invalid-feedback">
                            Please provide the Agility.
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="form-label" for="luck">Luck:</label>
                        <input class="form-control" type="number" name="luck" id="luck" placeholder="Luck" required>
                        <div class="invalid-feedback">
                            Please provide the Luck.
                        </div>
                    </div>
                    <div class="pt-4 text-center">
                        <button class="btn btn-primary" type="submit" name="create_enemy">Submit</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                    <?php
                    if (isset($_POST['create_enemy']))
                    {
                        $enemy_name = $_POST['enemy_name'];
                        $enemy_health = $_POST['enemy_health'];
                        $experience = $_POST['experience'];
                        $strength = $_POST['strength'];
                        $perception = $_POST['perception'];
                        $endurance = $_POST['endurance'];
                        $charisma = $_POST['charisma'];
                        $intelligence = $_POST['intelligence'];
                        $agility = $_POST['agility'];
                        $luck = $_POST['luck'];

                        echo createNewEnemy($enemy_name, $enemy_health, $experience, $strength, $perception, $endurance,
                                $charisma, $intelligence, $agility, $luck);
                    }
                    ?>
                </div>
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

