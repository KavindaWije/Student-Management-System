<?php
// Load the existing student data from students.json
$studentsData = file_get_contents('students.json');
$students = json_decode($studentsData, true);

// Check if the request method is POST and required fields are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sid'], $_POST['name'], $_POST['age'], $_POST['address'], $_POST['cgpa'])) {
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $cgpa = $_POST['cgpa'];

    // Find the student record with the matching SID
    $updated = false;
    foreach ($students as &$student) {
        if ($student['sid'] == $sid) {
            $student['name'] = $name;
            $student['age'] = $age;
            $student['address'] = $address;
            $student['cgpa'] = $cgpa;
            $updated = true;
            break;
        }
    }

    // Save the updated data back to students.json
    if ($updated) {
        $jsonUpdated = json_encode($students, JSON_PRETTY_PRINT);
        if (file_put_contents('students.json', $jsonUpdated)) {
            echo "Student updated successfully";
        } else {
            echo "Error updating student data";
        }
    } else {
        echo "Student not found";
    }
} else {
    echo "Invalid request";
}
?>
