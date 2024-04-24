<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Perkuliahan Data</title>
</head>
<body>
    <h1>View Perkuliahan Data</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Kode MK</th>
                <th>Nilai</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch all perkuliahan data
            $perkuliahan_data = json_decode(file_get_contents('http://localhost/uts/api/mahasiswaapi.php'), true);
            if ($perkuliahan_data['status'] == 1) {
                foreach ($perkuliahan_data['data'] as $perkuliahan) {
                    echo "<tr>";
                    echo "<td>" . $perkuliahan['id_perkuliahan'] . "</td>";
                    echo "<td>" . $perkuliahan['nim'] . "</td>";
                    echo "<td>" . $perkuliahan['kode_mk'] . "</td>";
                    echo "<td>" . $perkuliahan['nilai'] . "</td>";
                    echo "<td>";
                    echo '<form action="update.php" method="GET">';
                    echo '<input type="hidden" name="id_perkuliahan" value="' . $perkuliahan['id_perkuliahan'] . '">';
                    echo '<input type="submit" value="Update">';
                    echo '</form>';
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>" . $perkuliahan_data['message'] . "</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
