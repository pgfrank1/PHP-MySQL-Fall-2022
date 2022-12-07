<?php

require_once('dbconnection.php');
require_once('query-utils.php');

function createAdminUser($username, $password, $verify_password)
{
    $query = "SELECT UserName FROM Project4.Administrators WHERE UserName = ?";

    $result = parameterizedQuery(DBC, $query, 's', $username)
        or trigger_error(mysqli_error(DBC), E_USER_ERROR);

    if (mysqli_num_rows($result) == 0)
    {
        if ($password == $verify_password)
        {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO Project4.Administrators (`UserName`, `HashPassword`) VALUES (?, ?)";

            $result = parameterizedQuery(DBC, $query, 'ss', $username, $hashed_password)
                or trigger_error(mysqli_error(DBC), E_USER_ERROR);

            if ($result)
            {
                return '<br><p class="text-success">Admin User Added</p>';
            }
        }
        else
        {
            return '<br><p class="text-danger">Passwords do not match, please try again.</p>';
        }
    }
    else
    {
        return '<br><p class="text-danger">Username already exists, please try another username.</p>';
    }
}

function createNewItem($itemName, $itemDescription, $itemValue, $itemDefence, $itemAttackStrength)
{
    $query = "SELECT Name FROM Project4.Items WHERE Name = ?";

    $result = parameterizedQuery(DBC, $query, 's', $itemName)
        or trigger_error(mysqli_error(DBC), E_USER_ERROR);

    if (mysqli_num_rows($result) == 0)
    {
        $query = "INSERT INTO Project4.Items (`Name`, `Description`, `Value`, `Defence`, `AttackStrength`) VALUES (?, ?, ?, ?, ?)";

        $result = parameterizedQuery(DBC , $query, 'ssiii', $itemName, $itemDescription, $itemValue, $itemDefence, $itemAttackStrength)
            or trigger_error(mysqli_error(DBC), E_USER_ERROR);

        if ($result)
        {
            return '<br><p class="text-success">Item Added</p>';
        }
    }
    else
    {
        return '<br><p class="text-danger">Item already exists, please try another name.</p>';
    }
}

function createNewConsumable($consumable_name, $consumable_description, $consumable_value, $health_recovery, $stamina_recovery,
                             $mana_recovery, $strength_boost, $perception_boost, $endurance_boost, $charisma_boost,
                             $intelligence_boost, $agility_boost, $luck_boost, $duration)
{
    $query = "SELECT Name FROM Project4.Consumables WHERE Name = ?";

    $result = parameterizedQuery(DBC, $query, 's', $consumable_name)
        or trigger_error(mysqli_error(DBC), E_USER_ERROR);

    if (mysqli_num_rows($result) == 0)
    {
        $query = "INSERT INTO Project4.Consumables (`Name`, `Description`, `Value`, `HealthRecovery`, `StaminaRecovery`, `ManaRecovery`, `StrengthBoost`, `PerceptionBoost`, `EnduranceBoost`, `CharismaBoost`, `IntelligenceBoost`, `AgilityBoost`, `LuckBoost`, `Duration`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $result = parameterizedQuery(DBC , $query, 'ssiiiiiiiiiiii', $consumable_name, $consumable_description, $consumable_value, $health_recovery, $stamina_recovery, $mana_recovery, $strength_boost, $perception_boost, $endurance_boost, $charisma_boost, $intelligence_boost, $agility_boost, $luck_boost, $duration)
                or trigger_error(mysqli_error(DBC), E_USER_ERROR);

        if ($result)
        {
            return '<br><p class="text-success">Consumable Added</p>';
        }
    }
    else
    {
        return '<br><p class="text-danger">Consumable already exists, please try another name.</p>';
    }
}

function createNewEnemy($enemy_name, $enemy_health, $enemy_experience, $enemy_strength, $enemy_perception, $enemy_endurance,
                        $enemy_charisma, $enemy_intelligence, $enemy_agility, $enemy_luck)
{
    $query = "SELECT EnemyName FROM Project4.Enemies WHERE EnemyName = ?";

    $result = parameterizedQuery(DBC, $query, 's', $enemy_name)
    or trigger_error(mysqli_error(DBC), E_USER_ERROR);

    if (mysqli_num_rows($result) == 0)
    {
        $query = "INSERT INTO Project4.Enemies (`EnemyName`, `EnemyHealth`, `Experience`, `Strength`, `Perception`, `Endurance`, `Charisma`, `Intelligence`, `Agility`, `Luck`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $result = parameterizedQuery(DBC , $query, 'siiiiiiiii', $enemy_name, $enemy_health, $enemy_experience, $enemy_strength,
                $enemy_perception, $enemy_endurance, $enemy_charisma, $enemy_intelligence, $enemy_agility, $enemy_luck)
                or trigger_error(mysqli_error(DBC), E_USER_ERROR);

        if ($result)
        {
            return '<br><p class="text-success">Enemy Added</p>';
        }
    }
    else
    {
        return '<br><p class="text-danger">Enemy already exists, please try another name.</p>';
    }
}