<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "sait_db_uts";

// Get data sent via PUT request
$data = json_decode(file_get_contents("php://input"), true);

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement for update
$stmt = $conn->prepare("UPDATE mahasiswa_mata_kuliah SET nilai = ? WHERE nim = ? AND kode_mk = ?");
$stmt->bind_param("sss", $nilai, $nim, $kode_mk);

// Extract data from the request
$nim = $data['nim'];
$kode_mk = $data['kode_mk'];
$nilai = $data['nilai'];

// Execute SQL statement
if ($stmt->execute() === TRUE) {
    echo json_encode(array("message" => "Data updated successfully"));
} else {
    echo json_encode(array("error" => "Error updating data: " . $conn->error));
}

// Close statement and connection
$stmt->close();
$conn->close();
