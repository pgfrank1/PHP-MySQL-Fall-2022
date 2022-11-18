<?php

function parameterizedQuery($dbc, $query, $data_types, ...$query_parameters)
{
    $validated = false;

    if ($stmt = mysqli_prepare($dbc, $query))
    {
        if (mysqli_stmt_bind_param($stmt, $data_types, ...$query_parameters)
                && mysqli_stmt_execute($stmt))
        {
            $validated = mysqli_stmt_get_result($stmt);

            if (!mysqli_errno($dbc) && !$validated)
            {
                $validated = true;
            }
        }
    }
    return $validated;
}
?>