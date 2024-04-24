<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Perkuliahan Data</title>
</head>
<body>
    <h1>Delete Perkuliahan Data</h1>
    <table border="1">
        <tr>
            <th>ID Perkuliahan</th>
            <th>NIM</th>
            <th>Kode MK</th>
            <th>Nilai</th>
            <th>Action</th>
        </tr>
        <?php
        // Fetch perkuliahan data from the API
        $perkuliahanData = file_get_contents("http://localhost/uts/api/mahasiswaapi.php");
        $perkuliahans = json_decode($perkuliahanData, true);

        // Loop through each perkuliahan entry and display it in a table row
        foreach ($perkuliahans['data'] as $perkuliahan) {
            echo "<tr>";
            echo "<td>" . $perkuliahan['id_perkuliahan'] . "</td>";
            echo "<td>" . $perkuliahan['nim'] . "</td>";
            echo "<td>" . $perkuliahan['kode_mk'] . "</td>";
            echo "<td>" . $perkuliahan['nilai'] . "</td>";
            echo "<td>";
            echo '<form action="api/mahasiswaapi.php" method="DELETE">';
            echo '<input type="hidden" name="id_perkuliahan" value="' . $perkuliahan['id_perkuliahan'] . '">';
            echo '<input type="submit" value="Delete">';
            echo '</form>';
            echo "</td>";
            echo "</tr>";
        }
        ?>
