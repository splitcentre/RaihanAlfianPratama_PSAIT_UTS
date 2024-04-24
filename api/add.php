<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "sait_db_uts";

// Get data sent via POST request
$data = json_decode(file_get_contents("php://input"), true);

// Check if data is not null and has the expected structure
if ($data !== null && isset($data['nim']) && isset($data['kode_mk']) && isset($data['nilai'])) {
    // Extract data from the request
    $nim = $data['nim'];
    $kode_mk = $data['kode_mk'];
    $nilai = $data['nilai'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement for insertion
    $stmt = $conn->prepare("INSERT INTO perkuliahan (nim, kode_mk, nilai) VALUES (?, ?, ?)");
    
    // Check if statement preparation failed
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    // Bind parameters to the prepared statement
    $stmt->bind_param("ssi", $nim, $kode_mk, $nilai);

    // Execute SQL statement
    if ($stmt->execute() === TRUE) {
        echo json_encode(array("message" => "Data inserted successfully"));
    } else {
        // Print detailed error message
        echo json_encode(array("error" => "Error inserting data: " . $stmt->error));
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
