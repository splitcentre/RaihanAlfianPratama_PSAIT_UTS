<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Perkuliahan Data</title>
</head>
<body>
    <h1>Update Perkuliahan Data</h1>

    <?php
    // Check if the ID parameter is provided in the URL
    if(isset($_GET['id_perkuliahan'])) {
        $id_perkuliahan = $_GET['id_perkuliahan'];

        // Fetch the existing perkuliahan data based on the provided ID
        $perkuliahan_data = json_decode(file_get_contents('http://localhost/uts/api/mahasiswaapi.php?id_perkuliahan=' . $id_perkuliahan), true);

        // Check if the data is retrieved successfully
        if ($perkuliahan_data['status'] == 1 && !empty($perkuliahan_data['data'])) {
            $perkuliahan = $perkuliahan_data['data'][0]; // Assuming there's only one result

            // Display the update form with pre-filled data
            ?>
            <form action="http://localhost/uts/api/mahasiswaapi.php" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id_perkuliahan" value="<?php echo $perkuliahan['id_perkuliahan']; ?>">
                <label for="nim">NIM:</label>
                <input type="text" name="nim" id="nim" value="<?php echo $perkuliahan['nim']; ?>" required><br>
                <label for="kode_mk">Kode MK:</label>
                <input type="text" name="kode_mk" id="kode_mk" value="<?php echo $perkuliahan['kode_mk']; ?>" required><br>
                <label for="nilai">Nilai:</label>
                <input type="text" name="nilai" id="nilai" value="<?php echo $perkuliahan['nilai']; ?>" required><br>
                <input type="submit" value="Update">
            </form>
            <?php
        } else {
            // Display an error message if the data retrieval fails
            echo "<p>No perkuliahan data found for the provided ID.</p>";
        }
    } else {
        // Display an error message if the ID parameter is missing in the URL
        echo "<p>No ID parameter provided in the URL.</p>";
    }
    ?>

</body>
</html>

