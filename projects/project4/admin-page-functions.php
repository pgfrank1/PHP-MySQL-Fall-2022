<?php
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
