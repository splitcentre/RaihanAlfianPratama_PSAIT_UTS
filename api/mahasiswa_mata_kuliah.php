<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "sait_db_uts";

// Function to display grades of a specific student based on NIM
function displayGradesByNIM($nim) {
    // Create connection
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch grades for a specific student based on NIM
    $sql = "SELECT * FROM mahasiswa_mata_kuliah WHERE nim = '$nim'";

    // Execute query
    $result = $conn->query($sql);

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Initialize an empty array to store the results
        $data = array();

        // Loop through each row and add it to the data array
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Encode the data array to JSON and output it
        echo json_encode($data);
    } else {
        // If no rows are returned, output a message
        echo "No grades found for the student with NIM: $nim";
    }

    // Close connection
    $conn->close();
}

// Function to display grades of all students
function displayAllGrades() {
    // Create connection
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch grades for all students
    $sql = "SELECT * FROM mahasiswa_mata_kuliah";

    // Execute query
    $result = $conn->query($sql);

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Initialize an empty array to store the results
        $data = array();

        // Loop through each row and add it to the data array
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Encode the data array to JSON and output it
        echo json_encode($data);
    } else {
        // If no rows are returned, output a message
        echo "No grades found for any student.";
    }

    // Close connection
    $conn->close();
}

// Check if NIM parameter is set
if(isset($_GET['nim'])) {
    // Call the function to display grades for the provided NIM
    $nim = $_GET['nim'];
    displayGradesByNIM($nim);
} else {
    // If NIM parameter is not set, display grades for all students
    displayAllGrades();
}
?>
