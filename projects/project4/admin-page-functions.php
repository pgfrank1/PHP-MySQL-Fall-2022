<?php
function createAdminUser($username, $password, $verify_password)
    {
        require_once("dbconnection.php");
        require_once("query-utils.php");

        $query = "SELECT UserName FROM Project4.Administrators WHERE UserName = ?";

        $result = parameterizedQuery(DBC, $query, 's', $username)
            or trigger_error(mysqli_error(DBC), E_USER_ERROR);

        if (mysqli_num_rows($result) == 0)
        {
            if ($password == $verify_password)
            {
                $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $query = "INSERT INTO Project4.Administrators (`username`, `HashPassword`) VALUES (?, ?)";

                parameterizedQuery(DBC, $query, 'ss', $username, $hashed_password)
                    or trigger_error(mysqli_error(DBC), E_USER_ERROR);

                return "<h1> $username has been added </h1>";
            }
            else
            {
                return '<h1 class="text-danger">Passwords do not match, please try again.</h1>';
            }
        }
        else
        {
            return '<h1 class="text-danger">Username already exists, please try another username.</h1>';
        }
    }
