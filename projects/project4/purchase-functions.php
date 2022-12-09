<?php
    session_start();
    require_once ('dbconnection.php');
    require_once ('query-utils.php');

    function purchaseConsumables($consumableQueryResult)
    {
        $row = mysqli_fetch_assoc($consumableQueryResult);
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
                    <a href="the-game.php"><button class="btn btn-danger">Cancel</button></a>
                </div>
            </form>
        <?php
        }
        else
        {
            $total_cost = $_POST['consumable_quantity'] * $row['Value'];
            if (!isset($_POST['confirm_purchase']))
            {
            ?>
                <h1>Purchase <?= $_POST['consumable_quantity'] ?> <?= $row['Name']?>'s for <?= $total_cost ?>?</h1>
                <form class="needs-validation bg-light w-50 p-4 m-auto" novalidate method="POST" action="<?= $_SERVER['PHP_SELF']?>">
                    <div class="form-group">
                        <label class="form-label" for="consumable_quantity">Purchase how many <?= $row['Name']?>'s for <?=$row['Value']?> gold coins each?</label>
                        <input class="form-control" type="number" id="consumable_quantity" name="consumable_quantity">
                    </div>
                    <div class="pt-4 text-center">
                        <button class="btn btn-primary" type="submit" name="confirm_purchase">Purchase</button>
                        <button class="btn btn-danger" type="reset">Cancel</button>
                    </div>
                </form>
            <?php
            }
        }
    }