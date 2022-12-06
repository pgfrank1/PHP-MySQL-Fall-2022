<?php
const DB_HOST = 'localhost';
const DB_USER = 'student';
const DB_PASSWORD = 'student';
const DB_NAME = 'Project4';

define("DBC", mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME))
    or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);