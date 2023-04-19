<?php
require_once('Student.php');
$student = new Student(9);

$student->name = 'Patrick Frank';
$student->email = 'pgfrank@madisoncollege.edu';
echo $student;