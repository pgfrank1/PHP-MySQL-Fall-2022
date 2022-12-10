<?php
session_start();
require_once('dbconnection.php');
require_once('query-utils.php');
require_once('purchase-functions.php');


function getAllClassesForPlayer()
{
    $query = "SELECT `ClassId`, `Name` FROM Project4.Classes";

    $result = mysqli_query(DBC, $query)
        or trigger_error("There was an issue while querying the database", E_USER_ERROR);

    if (mysqli_num_rows($result))
    {
        $return_classes = '';
        while($row = mysqli_fetch_assoc($result))
        {
            $return_classes = $return_classes . '<option value="'.$row['ClassId'].'">'.$row['Name'].'</option>';
        }

        return $return_classes;
    }
    else
    {
        return '<option>NO CLASSES FOUND</option>';
    }
}

function calculateNewPlayerInformation($newPlayerClass)
{
    $newPlayerClass = $newPlayerClass -> fetch_array();

    $_SESSION['player_max_health'] = $newPlayerClass['Endurance'] * 10;
    $_SESSION['player_max_mana'] = $newPlayerClass['Intelligence'] * 10;
    $_SESSION['player_max_stamina'] = $newPlayerClass['Agility'] * 10;

    $_SESSION['player_current_health'] = $_SESSION['player_max_health'];
    $_SESSION['player_current_mana'] = $_SESSION['player_max_mana'];
    $_SESSION['player_current_stamina'] = $_SESSION['player_max_stamina'];

    $_SESSION['player_class_name'] = $newPlayerClass['Name'];
    $_SESSION['player_strength'] = $newPlayerClass['Strength'];
    $_SESSION['player_perception'] = $newPlayerClass['Perception'];
    $_SESSION['player_endurance'] = $newPlayerClass['Endurance'];
    $_SESSION['player_charisma'] = $newPlayerClass['Charisma'];
    $_SESSION['player_intelligence'] = $newPlayerClass['Intelligence'];
    $_SESSION['player_agility'] = $newPlayerClass['Agility'];
    $_SESSION['player_luck'] = $newPlayerClass['Luck'];

    $_SESSION['new_player_start'] = true;
    $_SESSION['output_dialogue'] = '';

    $_SESSION['player_inventory'] = array();
    $_SESSION['player_inventory']['Gold'] = 999;

    $_SESSION['player_equipment'] = array();
    $_SESSION['player_equipment']['Head'];
    $_SESSION['player_equipment']['Head']['Defence'];
    $_SESSION['player_equipment']['Head']['AttackStrength'];
    $_SESSION['player_equipment']['Chest'];
    $_SESSION['player_equipment']['Chest']['Defence'];
    $_SESSION['player_equipment']['Chest']['AttackStrength'];
    $_SESSION['player_equipment']['Right Arm'];
    $_SESSION['player_equipment']['Right Arm']['Defence'];
    $_SESSION['player_equipment']['Right Arm']['AttackStrength'];
    $_SESSION['player_equipment']['Left Arm'];
    $_SESSION['player_equipment']['Left Arm']['Defence'];
    $_SESSION['player_equipment']['Left Arm']['AttackStrength'];
    $_SESSION['player_equipment']['Legs'];
    $_SESSION['player_equipment']['Legs']['Defence'];
    $_SESSION['player_equipment']['Legs']['AttackStrength'];
    $_SESSION['player_equipment']['Boots'];
    $_SESSION['player_equipment']['Boots']['Defence'];
    $_SESSION['player_equipment']['Boots']['AttackStrength'];

    $_SESSION['player_defence'] = 0;
    $_SESSION['player_attack_strength'] = 0;
}

function getPlayerLocation()
{
    if (isset($_GET['goToTavern']))
    {
        $_SESSION['player_in_tavern'] = true;
        $_SESSION['player_in_town'] = false;
        $_SESSION['player_in_smithy'] = false;
        $_SESSION['player_in_apothecary'] = false;
    }
    elseif (isset($_GET['goToSmithy']))
    {
        $_SESSION['player_in_tavern'] = false;
        $_SESSION['player_in_town'] = false;
        $_SESSION['player_in_smithy'] = true;
        $_SESSION['player_in_apothecary'] = false;
    }
    if (isset($_GET['goToApothecary']))
    {
        $_SESSION['player_in_tavern'] = false;
        $_SESSION['player_in_town'] = false;
        $_SESSION['player_in_smithy'] = false;
        $_SESSION['player_in_apothecary'] = true;
    }
    if (isset($_GET['goToTown']))
    {
        $_SESSION['player_in_tavern'] = false;
        $_SESSION['player_in_town'] = true;
        $_SESSION['player_in_smithy'] = false;
        $_SESSION['player_in_apothecary'] = false;
    }
}

function setInventoryAndEquipment()
{
    $query = "SELECT * FROM Project4.Items WHERE ItemId = ?";

    $result = parameterizedQuery(DBC, $query, 's', $_GET['equipItemId'])
        or trigger_error(mysqli_error(DBC), E_USER_ERROR);

    $row = mysqli_fetch_assoc($result);

    if (isset($_GET['equipItemId']))
    {
        if (mysqli_num_rows($result) == 1)
        {
            $current_item = $_SESSION['player_equipment'][$row['Equip_Slot']];
            $item_to_equip = $row['Name'];

            if ($current_item == null)
            {
                $_SESSION['player_equipment'][$row['Equip_Slot']] = $item_to_equip;
                $_SESSION['player_defence'] += $row['Defence'];
                $_SESSION['player_attack_strength'] += $row['AttackStrength'];


                if ($_SESSION['player_inventory'][$item_to_equip] > 1)
                {
                    $_SESSION['player_inventory'][$item_to_equip] -= 1;
                }
                else
                {
                    unset($_SESSION['player_inventory'][$item_to_equip]);
                }
            }
            else
            {
                $query2 = "SELECT * FROM Project4.Items WHERE `Name` = ?";

                $result2 = parameterizedQuery(DBC, $query2, 's', $current_item)
                    or trigger_error(mysqli_error(DBC), E_USER_ERROR);

                $row2 = mysqli_fetch_assoc($result2);

                $_SESSION['player_defence'] -= $row2['Defence'];
                $_SESSION['player_attack_strength'] -= $row2['AttackStrength'];


                $_SESSION['player_defence'] += $row['Defence'];
                $_SESSION['player_attack_strength'] += $row['AttackStrength'];

                if ($_SESSION['player_inventory'][$item_to_equip] > 1)
                {
                    $_SESSION['player_equipment'][$row['Equip_Slot']] = $item_to_equip;
                    $_SESSION['player_inventory'][$item_to_equip] -= 1;
                }
                else
                {
                    $_SESSION['player_equipment'][$row['Equip_Slot']] = $item_to_equip;
                    unset($_SESSION['player_inventory'][$item_to_equip]);
                }
                if(key_exists($current_item, $_SESSION['player_inventory']))
                {
                    $_SESSION['player_inventory'][$current_item] += 1;
                }
                else
                {
                    $_SESSION['player_inventory'][$current_item] = 1;
                }
            }
        }
    }
}

function theGameOutput()
{
    if (isset($_POST['purchase_consumable']))
    {
        $_SESSION['user_quantity'] = $_POST['consumable_quantity'];
        $total_cost = $_SESSION['user_quantity'] * $_SESSION['consumable_value'];

        if ($_SESSION['player_inventory']['Gold'] < $total_cost)
        {
            $_SESSION['output_dialogue'] .= '<p>Cannot make purchase, you don\'t have enough gold</p>';
        }
        else
        {
            $_SESSION['player_inventory']['Gold'] -= $total_cost;
            $_SESSION['output_dialogue'] .= '<p>You have paid '. $total_cost .' gold for ' . $_SESSION['user_quantity'] . ' ' . $_SESSION['consumable_name'] .'s.</p>';
            if (key_exists($_SESSION['consumable_name'], $_SESSION['player_inventory']))
            {
                $_SESSION['player_inventory'][$_SESSION['consumable_name']] += $_SESSION['user_quantity'];
            }
            else
            {
                $_SESSION['player_inventory'][$_SESSION['consumable_name']] = $_SESSION['user_quantity'];
            }
        }
    }
    elseif (isset($_POST['purchase_item']))
    {
        $_SESSION['user_quantity'] = $_POST['item_quantity'];
        $total_cost = $_SESSION['user_quantity'] * $_SESSION['item_value'];

        if ($_SESSION['player_inventory']['Gold'] < $total_cost)
        {
            $_SESSION['output_dialogue'] .= '<p>Cannot make purchase, you don\'t have enough gold</p>';
        }
        else
        {
            $_SESSION['player_inventory']['Gold'] -= $total_cost;
            $_SESSION['output_dialogue'] .= '<p>You have paid '. $total_cost .' gold for a ' . $_SESSION['item_name'] .'.</p>';
            if (key_exists($_SESSION['item_name'], $_SESSION['player_inventory']))
            {
                $_SESSION['player_inventory'][$_SESSION['item_name']] += $_SESSION['user_quantity'];
            }
            else
            {
                $_SESSION['player_inventory'][$_SESSION['item_name']] = $_SESSION['user_quantity'];
            }
        }
    }


    if(isset($_GET['purchaseConsumableId']))
    {
        $query = "SELECT * FROM Project4.Consumables WHERE ConsumableId = ?";

        $result = parameterizedQuery(DBC, $query, 'i', $_GET['purchaseConsumableId'])
            or trigger_error(mysqli_error(DBC), E_USER_ERROR);

        if (mysqli_num_rows($result) == 1)
        {
            purchaseConsumables($result);
        }
    }
    elseif (isset($_GET['purchaseItemId']))
    {
        $query = "SELECT * FROM Project4.Items WHERE ItemId = ?";

        $result = parameterizedQuery(DBC, $query, 'i', $_GET['purchaseItemId'])
            or trigger_error(mysqli_error(DBC), E_USER_ERROR);

        if (mysqli_num_rows($result) == 1)
        {
            purchaseItems($result);
        }
    }
    else
    {
        if ($_SESSION['new_player_start'])
        {
            $_SESSION['new_player_start'] = false;
            $_SESSION['player_in_town'] = true;
            $_SESSION['output_dialogue'] .= '<p class="bg-light">You find yourself tired of the slow tedious life of a farmer and seek adventure! Your family gives you 100 gold to start your journey. They recommend that you go get some equipment</p>';
            $_SESSION['output_dialogue'] .= '<p>You enter the town. You can go to the tavern for quests and rewards, the smithy to buy better gear, and the apothecary to stock up on potions.</p>';
            echo $_SESSION['output_dialogue'];
        }
        elseif ($_SESSION['player_in_town'])
        {
            $_SESSION['output_dialogue'] .= '<p>You are in the town. You can go to the tavern for quests and rewards, the smithy to buy better gear, and the apothecary to stock up on potions.</p>';
            echo $_SESSION['output_dialogue'];
        }
        elseif ($_SESSION['player_in_tavern'])
        {
            $_SESSION['output_dialogue'] .= '<p>You are in the tavern. You can go to the job board to look at available quests and their rewards</p>';
            echo $_SESSION['output_dialogue'];
        }
        elseif ($_SESSION['player_in_smithy'])
        {
            $_SESSION['output_dialogue'] .= '<p>You are in the smithy. You can buy weapons and armor here</p>';
            echo $_SESSION['output_dialogue'];
        }
        elseif ($_SESSION['player_in_apothecary'])
        {
            $_SESSION['output_dialogue'] .= '<p>You are in the apothecary. You can buy potions for your health, mana, stamina and even attribute boosts.</p>';
            echo $_SESSION['output_dialogue'];
        }
    }
}

function displayInventory()
{
    $query = "SELECT * FROM Project4.Items WHERE Name = ?";

    echo '<tr>';
    $max_of_three_columns = 0;
    foreach($_SESSION['player_inventory'] as $key=>$value)
    {
        if ($max_of_three_columns == 3)
        {
            echo '</tr><tr>';
        }

        $result = parameterizedQuery(DBC, $query, 's', $key)
            or trigger_error(mysqli_error(DBC), E_USER_ERROR);

        if (mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);

            echo '<td class="text-light bg-primary"><a class="text-light" href="the-game.php?equipItemId=' . $row['ItemId'] . '#bottom_of_dialogue">' . $value . ' ' . $key . '</a></td>';

        }
        else
        {
            echo '<td class="text-light bg-primary">' . $value . ' ' . $key . '</td>';
        }
    $max_of_three_columns++;
    }
    echo '</tr>';
}

function displayEquipment()
{?>
    <tr>
        <td></td>
        <td class="text-light">Head<br><?= $_SESSION['player_equipment']['Head']?></td>
        <td></td>
    </tr>
    <tr>
        <td class="text-light">Left Arm<br><?= $_SESSION['player_equipment']['Left Arm'] ?></td>
        <td class="text-light">Chest<br><?= $_SESSION['player_equipment']['Chest'] ?></td>
        <td class="text-light">Right Arm<br><?= $_SESSION['player_equipment']['Right Arm'] ?></td>
    </tr>
    <tr>
        <td class="text-light"></td>
        <td class="text-light">Legs<br><?= $_SESSION['player_equipment']['Legs'] ?></td>
        <td class="text-light"></td>
    </tr>
    <tr>
        <td class="text-light"></td>
        <td class="text-light">Boots<?= $_SESSION['player_equipment']['Boots'] ?></td>
        <td class="text-light"></td>
    </tr>
    <?php
}

function displayActions()
{
    // TODO: Randomly generate enemies to kill on a quest or have people encounter them when they leave town
    if ($_SESSION['player_in_town'])
    {
        echo '<tr>
                <td class="text-light">
                    <a class="text-light decoration-none" href="the-game.php?goToTavern#bottom_of_dialogue">Go to Tavern</a>
                </td>
                <td class="text-light">
                    <a class="text-light decoration-none" href="the-game.php?goToSmithy#bottom_of_dialogue" >Go to Smithy</a>
                </td>
                <td class="text-light">
                    <a class="text-light decoration-none" href="the-game.php?goToApothecary#bottom_of_dialogue" >Go to Apothecary</a>
                </td>
              </tr>
              <tr>
              </tr>';

    }
    elseif ($_SESSION['player_in_tavern'])
    {
        echo '<tr>
                <td class="text-light">
                    <a class="text-light decoration-none" href="the-game.php?goToTown#bottom_of_dialogue">Go to Town</a>
                </td>
                <td class="text-light">
                    <a class="text-light decoration-none" href="the-game.php?goToSmithy#bottom_of_dialogue">Go to Smithy</a>
                </td>
                <td class="text-light">
                    <a class="text-light decoration-none" href="the-game.php?goToApothecary#bottom_of_dialogue">Go to Apothecary</a>
                </td>
              </tr>';
    }
    elseif ($_SESSION['player_in_smithy'])
    {
        $query = "SELECT * FROM Project4.Items";

        $result = mysqli_query(DBC, $query)
            or trigger_error(mysqli_error(DBC), E_USER_ERROR);

        echo '<tr>
                <td class="text-light">
                    <a class="text-light decoration-none" href="the-game.php?goToTown#bottom_of_dialogue">Go to Town</a>
                </td>
                <td class="text-light">
                    <a class="text-light decoration-none" href="the-game.php?goToTavern#bottom_of_dialogue"">Go to Tavern</a>
                </td>
                <td class="text-light">
                    <a class="text-light decoration-none" href="the-game.php?goToApothecary#bottom_of_dialogue">Go to Apothecary</a>
                </td>
              </tr>';

        if ($result)
        {
            echo '<tr>';
            $max_of_three_columns = 0;
            while ($row = mysqli_fetch_assoc($result))
            {
                if ($max_of_three_columns == 3)
                {
                    $max_of_three_columns = 0;
                    echo '</tr><tr>';
                }
                echo '<td class="text-light">
                            <a class="text-light" href="the-game.php?purchaseItemId=' . $row['ItemId'] . '#bottom_of_dialogue">' . $row['Name'] . '</a>
                        </td>';
                $max_of_three_columns++;
            }
            echo '</tr>';
        }
    }
    elseif ($_SESSION['player_in_apothecary'])
    {
        $query = "SELECT * FROM Project4.Consumables";

        $result = mysqli_query(DBC, $query)
            or trigger_error(mysqli_error(DBC), E_USER_ERROR);

        echo '<tr>
                <td class="text-light">
                    <a class="text-light decoration-none" href="the-game.php?goToTown#bottom_of_dialogue">Go to Town</a>
                </td>
                <td class="text-light">
                    <a class="text-light decoration-none" href="the-game.php?goToSmithy#bottom_of_dialogue">Go to Smithy</a>
                </td>
                <td class="text-light">
                    <a class="text-light decoration-none" href="the-game.php?goToTavern#bottom_of_dialogue">Go to Tavern</a>
                </td>
              </tr>
              <tr><td class="text-light" colspan="3">Potions</td></tr>';

        if ($result)
        {
            echo '<tr>';
            $max_of_three_columns = 0;
            while ($row = mysqli_fetch_assoc($result))
            {
                if ($max_of_three_columns == 3)
                {
                    $max_of_three_columns = 0;
                    echo '</tr><tr>';
                }
                    echo '<td class="text-light">
                            <a class="text-light" href="the-game.php?purchaseConsumableId=' . $row['ConsumableId'] . '#bottom_of_dialogue">' . $row['Name'] . '</a>
                        </td>';
                $max_of_three_columns++;
            }
            echo '</tr>';
        }
    }
}