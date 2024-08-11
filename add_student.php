<?php
// Load existing student data from students.json
$studentsData = file_get_contents('students.json');
$students = json_decode($studentsData, true);

// Check if the request method is POST and required fields are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sid'], $_POST['name'], $_POST['age'], $_POST['address'], $_POST['cgpa'])) {
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $cgpa = $_POST['cgpa'];

    // Check if SID already exists
    $existingStudent = array_filter($students, function ($student) use ($sid) {
        return $student['sid'] == $sid;
    });

    if (!empty($existingStudent)) {
        echo "Student with SID $sid already exists.";
    } else {
        // Add the new student to the array
        $newStudent = [
            'sid' => $sid,
            'name' => $name,
            'age' => $age,
            'address' => $address,
            'cgpa' => $cgpa
        ];
        $students[] = $newStudent;

        // Save the updated data back to students.json
        $jsonUpdated = json_encode($students, JSON_PRETTY_PRINT);
        if (file_put_contents('students.json', $jsonUpdated)) {
            echo "New student added successfully.";
        } else {
            echo "Error adding new student.";
        }
    }
} else {
    echo "Invalid request.";
}
?>
