<?php
require_once "config.php";
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id_perkuliahan"])) {
            $id = intval($_GET["id_perkuliahan"]);
            get_perkuliahan($id);
        } else {
            get_perkuliahans();
        }
        break;
    case 'POST':
        if (!empty($_GET["id_perkuliahan"])) {
            $id = intval($_GET["id_perkuliahan"]);
            update_perkuliahan($id);
        } else {
            insert_perkuliahan();
        }
        break;
    case 'DELETE':
        $id = intval($_GET["id_perkuliahan"]);
        delete_perkuliahan($id);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_perkuliahans()
{
    global $mysqli;
    $query = "SELECT * FROM perkuliahan";
    $data = array();
    $result = $mysqli->query($query);
    while ($row = mysqli_fetch_object($result)) {
        $data[] = $row;
    }
    $response = array(
        'status' => 1,
        'message' => 'Get List Perkuliahan Successfully.',
        'data' => $data
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}

function get_perkuliahan($id = 0)
{
    global $mysqli;
    $query = "SELECT * FROM perkuliahan";
    if ($id != 0) {
        $query .= " WHERE id_perkuliahan=" . $id . " LIMIT 1";
    }
    $data = array();
    $result = $mysqli->query($query);
    while ($row = mysqli_fetch_object($result)) {
        $data[] = $row;
    }
    $response = array(
        'status' => 1,
        'message' => 'Get Perkuliahan Successfully.',
        'data' => $data
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}

function insert_perkuliahan()
{
    global $mysqli;
    if (!empty($_POST["nim"]) && !empty($_POST["kode_mk"]) && !empty($_POST["nilai"])) {
        $nim = $_POST["nim"];
        $kode_mk = $_POST["kode_mk"];
        $nilai = $_POST["nilai"];

        $result = mysqli_query($mysqli, "INSERT INTO perkuliahan (nim, kode_mk, nilai) VALUES ('$nim', '$kode_mk', $nilai)");

        if ($result) {
            $response = array(
                'status' => 1,
                'message' => 'Perkuliahan Added Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Perkuliahan Addition Failed.'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Invalid or missing data in the request'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function update_perkuliahan($id)
{
    global $mysqli;
    if (!empty($_POST["nim"]) && !empty($_POST["kode_mk"]) && isset($_POST["nilai"])) {
        $data = $_POST;
    } else {
        $data = json_decode(file_get_contents('php://input'), true);
    }

    $arrcheckpost = array('nim' => '', 'kode_mk' => '', 'nilai' => '');
    $hitung = count(array_intersect_key($data, $arrcheckpost));
    if ($hitung == count($arrcheckpost)) {

        $nim = $data["nim"];
        $kode_mk = $data["kode_mk"];
        $nilai = $data["nilai"];

        $result = mysqli_query($mysqli, "UPDATE perkuliahan SET
              nim = '$nim',
              kode_mk = '$kode_mk',
              nilai = $nilai
              WHERE id_perkuliahan='$id'");

        if ($result) {
            $response = array(
                'status' => 1,
                'message' => 'Perkuliahan Updated Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Perkuliahan Updation Failed.'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Parameter Do Not Match'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function delete_perkuliahan($id)
{
    global $mysqli;
    $query = "DELETE FROM perkuliahan WHERE id_perkuliahan=" . $id;
    if (mysqli_query($mysqli, $query)) {
        $response = array(
            'status' => 1,
            'message' => 'Perkuliahan Deleted Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Perkuliahan Deletion Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
