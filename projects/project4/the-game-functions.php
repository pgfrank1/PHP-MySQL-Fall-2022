<?php
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