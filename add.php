<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Perkuliahan Data</title>
</head>
<body>
    <h1>Add Perkuliahan Data</h1>
    <form action="http://localhost/uts/api/mahasiswaapi.php" method="POST">
        <label for="nim">NIM:</label>
        <input type="text" name="nim" id="nim" required><br>
        <label for="kode_mk">Kode MK:</label>
        <input type="text" name="kode_mk" id="kode_mk" required><br>
        <label for="nilai">Nilai:</label>
        <input type="text" name="nilai" id="nilai" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
