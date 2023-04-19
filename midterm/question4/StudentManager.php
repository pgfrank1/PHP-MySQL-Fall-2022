<?php
    require_once('Student.php');

    class StudentManager
    {
        public function readAll() {
            $db = new PDO("mysql:host=localhost;dbname=MadisonCollege", "student", "student");

            $sql = "SELECT * FROM MadisonCollege.student";

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            try
            {
                $query = $db->prepare($sql);
                $query->execute();

                $result = $query->fetchAll(PDO::FETCH_CLASS, "Student");
            }
            catch (Exception $e)
            {
                echo $e->getMessage() . "<br>";
            }

            foreach($result as $student) {
                echo $student;
            }
        }
    }
$output = new StudentManager();
$output->readAll();