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
    $_SESSION['player_max_stamina'] = $newPlayerClass['Strength'] * 10;

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
    $_SESSION['player_inventory']['Gold'] = 100;

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
        //$_SESSION['user_quantity'] = $_POST['consumable_quantity'];
        $total_cost = $_SESSION['item_value'];

        if ($_SESSION['player_inventory']['Gold'] < $total_cost)
        {
            $_SESSION['output_dialogue'] .= '<p>Cannot make purchase, you don\'t have enough gold</p>';
        }
        else
        {
            $_SESSION['player_inventory']['Gold'] -= $total_cost;
            $_SESSION['output_dialogue'] .= '<p>You have paid '. $total_cost .' gold for ' . $_SESSION['user_quantity'] . ' ' . $_SESSION['item_name'] .'.</p>';

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

function displayActions()
{
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
            while ($row = mysqli_fetch_assoc($result))
            {
                echo '<td class="text-light">
                            <a class="text-light" href="the-game.php?purchaseConsumableId=' . $row['ConsumableId'] . '#bottom_of_dialogue">' . $row['Name'] . '</a>
                        </td>';
            }
            echo '</tr>';
        }
    }
}