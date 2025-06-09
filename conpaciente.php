<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclui o script de conexão existente
require_once 'conexao.php';
$con->set_charset("utf8");

// Decodifica o JSON recebido
$input = json_decode(file_get_contents('php://input'), true);
$nmPaciente = isset($input['nmPaciente']) ? trim($input['nmPaciente']) : '';

if ($nmPaciente !== '') {
    // Consulta com filtro
    $sql = "SELECT IdPaciente, nmPaciente, dtnascPaciente, sxPaciente, jdPaciente, udPaciente, tsPaciente 
            FROM cpaPaciente 
            WHERE nmPaciente LIKE ?";
    $stmt = $con->prepare($sql);
    $likeParam = '%' . $nmPaciente . '%';
    $stmt->bind_param('s', $likeParam);
} else {
    // Consulta sem filtro
    $sql = "SELECT IdPaciente, nmPaciente, dtnascPaciente, sxPaciente, jdPaciente, udPaciente, tsPaciente 
            FROM cpaPaciente";
    $stmt = $con->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

$response = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = array_map(fn($val) => mb_convert_encoding($val, 'UTF-8', 'ISO-8859-1'), $row);
    }
} else {
    $response[] = [
        "IdPaciente"     => 0,
        "nmPaciente"     => "",
        "dtnascPaciente" => "",
        "sxPaciente"     => "",
        "jdPaciente"     => "",
        "udPaciente"     => "",
        "tsPaciente"     => ""
    ];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);

$stmt->close();
$con->close();

?>
