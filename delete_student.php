<?php
// Load the existing student data from students.json
$studentsData = file_get_contents('students.json');
$students = json_decode($studentsData, true);

// Check if the request method is POST and if SID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sid'])) {
    $sid = $_POST['sid'];

    // Find the index of the student with the matching SID
    $index = null;
    foreach ($students as $key => $student) {
        if ($student['sid'] == $sid) {
            $index = $key;
            break;
        }
    }

    if ($index !== null) {
        // Remove the student from the array
        array_splice($students, $index, 1);

        // Save the updated data back to students.json
        $jsonUpdated = json_encode($students, JSON_PRETTY_PRINT);
        if (file_put_contents('students.json', $jsonUpdated)) {
            echo "Student deleted successfully";
        } else {
            echo "Error deleting student data";
        }
    } else {
        echo "Student not found";
    }
} else {
    echo "Invalid request";
}
?>
