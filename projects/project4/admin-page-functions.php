<?php

require('dbconnection.php');
require('query-utils.php');

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

function createNewItem($itemName, $itemDescription, $item_equip_slot, $itemValue, $itemDefence, $itemAttackStrength)
{
    $query = "SELECT Name FROM Project4.Items WHERE Name = ?";

    $result = parameterizedQuery(DBC, $query, 's', $itemName)
        or trigger_error(mysqli_error(DBC), E_USER_ERROR);

    if (mysqli_num_rows($result) == 0)
    {
        $query = "INSERT INTO Project4.Items (`Name`, `Description`, `Equip_Slot`, `Value`, `Defence`, `AttackStrength`) VALUES (?, ?, ?, ?, ?, ?)";

        $result = parameterizedQuery(DBC , $query, 'sssiii', $itemName, $itemDescription, $item_equip_slot, $itemValue, $itemDefence, $itemAttackStrength)
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

function createNewClass($class_name, $strength, $perception, $endurance, $charisma, $intelligence, $agility, $luck)
{
    $query = "SELECT Name FROM Project4.Classes WHERE Name = ?";

    $result = parameterizedQuery(DBC, $query, 's', $class_name)
    or trigger_error(mysqli_error(DBC), E_USER_ERROR);

    if (mysqli_num_rows($result) == 0)
    {
        $query = "INSERT INTO Project4.Classes (`Name`, `Strength`, `Perception`, `Endurance`, `Charisma`, `Intelligence`, `Agility`, `Luck`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $result = parameterizedQuery(DBC , $query, 'siiiiiii', $class_name, $strength, $perception, $endurance, $charisma,
                $intelligence, $agility, $luck)
            or trigger_error(mysqli_error(DBC), E_USER_ERROR);

        if ($result)
        {
            return '<br><p class="text-success">Class Added</p>';
        }
    }
    else
    {
        return '<br><p class="text-danger">Class already exists, please try another name.</p>';
    }
}

function getAllClassesForAttacks()
{
    $query = "SELECT `ClassId`, `Name` FROM Project4.Classes";

    $result = mysqli_query(DBC, $query)
        or trigger_error("There was an issue while querying the database", E_USER_ERROR);

    if (mysqli_num_rows($result))
    {
        $return_classes = '<div class="w-50 m-auto">';
        while($row = mysqli_fetch_assoc($result))
        {
            $return_classes = $return_classes . '<div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="class_id" name="class_id[]" value="'.htmlspecialchars($row['ClassId']).'"><label class="form-check-label" for="class_name">'.htmlspecialchars($row['Name']).'</label></div>';
        }

        return $return_classes . '</div>';
    }
    else
    {
        return '<p>NO CLASSES FOUND</p>';
    }
}

function createNewAttack($attack_name, $main_attribute, $class_ids)
{
    $query = "SELECT AttackName FROM Project4.Attacks WHERE AttackName = ?";

    $result_attack = parameterizedQuery(DBC , $query, 's', $attack_name)
        or trigger_error(mysqli_error(DBC), E_USER_ERROR);

    if(mysqli_num_rows($result_attack) == 0)
    {
        $query_attack = "INSERT INTO Project4.Attacks VALUES (null, ?, ?)";

        $result_attack = parameterizedQuery(DBC , $query_attack, 'ss', $attack_name, $main_attribute)
            or trigger_error(mysqli_error(DBC), E_USER_ERROR);

        if ($result_attack)
        {
            $query = "SELECT AttackId FROM Project4.Attacks WHERE AttackName = ?";

            $result_attack_id = parameterizedQuery(DBC , $query, 's', $attack_name)
                or trigger_error(mysqli_error(DBC), E_USER_ERROR);

            if ($result_attack_id)
            {

                $attack_id = mysqli_fetch_assoc($result_attack_id)['AttackId'];
                $added_attacks_to_classes = false;
                foreach ($class_ids as $class_id)
                {
                    $query_attack_class = "INSERT INTO Project4.Class_Attacks VALUES (?, ?)";

                    $result_attack_class = parameterizedQuery(DBC, $query_attack_class, 'ii', $class_id, $attack_id)
                        or trigger_error(mysqli_error(DBC), E_USER_ERROR);

                    $added_attacks_to_classes = $result_attack_class;
                }
                if ($added_attacks_to_classes)
                {
                    return "<p class='text-success'>Attack added to classes</p>";
                }
            }
        }
    }
    else
    {
        return '<br><p class="text-danger">Attack already exists, please try another name.</p>';
    }
}