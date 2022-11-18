<?php
    function calculateAge($birthdate) 
    {
        $today = date("Y-m-d");
        $age = date_diff(date_create($birthdate), date_create($today));
        $age = $age->format('%y');
        return $age;
    }
?>