<?php
session_start();
require_once('dbconnection.php');
require_once('query-utils.php');

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

    $_SESSION['player_strength'] = $newPlayerClass['Strength'];
    $_SESSION['player_perception'] = $newPlayerClass['Perception'];
    $_SESSION['player_endurance'] = $newPlayerClass['Endurance'];
    $_SESSION['player_charisma'] = $newPlayerClass['Charisma'];
    $_SESSION['player_intelligence'] = $newPlayerClass['Intelligence'];
    $_SESSION['player_agility'] = $newPlayerClass['Agility'];
    $_SESSION['player_luck'] = $newPlayerClass['Luck'];

}

function getPlayerStrength()
{
    $query = "SELECT Strength FROM Project4.Classes";

    $result_class_strength = mysqli_query(DBC, $query)
        or trigger_error("There was an issue while querying the database", E_USER_ERROR);

    if (mysqli_num_rows($result_class_strength))
    {
        $query = "SELECT Strength FROM Project4.Player_Class";

        $result_player_strength = mysqli_query(DBC, $query)
            or trigger_error("There was an issue while querying the database", E_USER_ERROR);

        if (mysqli_num_rows($result_player_strength))
        {
            return mysqli_fetch_assoc($result_class_strength)['Strength'];
        }
    }
}

function getPlayerPerception()
{

}

function getPlayerEndurance()
{

}

function getPlayerCharisma()
{

}

function getPlayerIntelligence()
{

}

function getPlayerAgility()
{

}

function getPlayerLuck()
{

}