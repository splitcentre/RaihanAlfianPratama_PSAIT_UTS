<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Mahasiswa Mata Kuliah</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Mahasiswa Mata Kuliah</h1>

    <!-- Display Table for Mahasiswa Mata Kuliah -->
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>SKS</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "sait_db_uts";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to fetch data from the view table
            $sql = "SELECT * FROM mahasiswa_mata_kuliah";

            // Execute query
            $result = $conn->query($sql);

            // Check if there are rows returned
            if ($result->num_rows > 0) {
                // Loop through each row and display data in a table row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['nim']}</td>";
                    echo "<td>{$row['nama_mahasiswa']}</td>";
                    echo "<td>{$row['alamat']}</td>";
                    echo "<td>{$row['tanggal_lahir']}</td>";
                    echo "<td>{$row['kode_mk']}</td>";
                    echo "<td>{$row['nama_mk']}</td>";
                    echo "<td>{$row['sks']}</td>";
                    echo "<td>{$row['nilai']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No data found</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
