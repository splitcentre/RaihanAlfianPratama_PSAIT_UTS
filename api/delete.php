<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "sait_db_uts";

// Get data sent via DELETE request
$nim = $_GET['nim'];
$kode_mk = $_GET['kode_mk'];

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement for deletion
$stmt = $conn->prepare("DELETE FROM mahasiswa_mata_kuliah WHERE nim = ? AND kode_mk = ?");
$stmt->bind_param("ss", $nim, $kode_mk);

// Execute SQL statement
if ($stmt->execute() === TRUE) {
    echo json_encode(array("message" => "Data deleted successfully"));
} else {
    echo json_encode(array("error" => "Error deleting data: " . $conn->error));
}

// Close statement and connection
$stmt->close();
$conn->close();
