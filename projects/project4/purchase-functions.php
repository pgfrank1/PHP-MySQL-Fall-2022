<?php
    session_start();
    require_once ('dbconnection.php');
    require_once ('query-utils.php');

    function purchaseConsumables($consumableQueryResult)
    {
        unset($_SESSION['user_quantity']);
        $row = mysqli_fetch_assoc($consumableQueryResult);

        $_SESSION['consumable_value'] = $row['Value'];
        $_SESSION['consumable_name'] = $row['Name'];

        if(!isset($_POST['purchase_consumable']))
        {
        ?>
            <form class="needs-validation bg-light w-50 p-4 m-auto" novalidate method="POST" action="<?= $_SERVER['PHP_SELF']?>">
                <div class="form-group">
                    <label class="form-label" for="consumable_quantity">Purchase how many <?= $row['Name']?>'s for <?=$row['Value']?> gold coins each?</label>
                    <input class="form-control" type="number" id="consumable_quantity" name="consumable_quantity">
                </div>
                <div class="pt-4 text-center">
                    <button class="btn btn-primary" type="submit" name="purchase_consumable">Purchase</button>
                    <a class="btn btn-danger" href="the-game.php">Cancel</a>
                </div>
            </form>
        <?php
        }
    }