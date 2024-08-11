<?php
header('Content-Type: application/json');
$students = json_decode(file_get_contents('students.json'), true);
$sid = $_GET['sid'];
$student = array_filter($students, function ($student) use ($sid) {
    return $student['sid'] == $sid;
});
echo json_encode($student);
?>

