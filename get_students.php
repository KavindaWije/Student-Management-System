<?php
header('Content-Type: application/json');
$students_json = file_get_contents('students.json');
echo $students_json;
?>
