<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define content type
header('Content-Type: application/json');

// Include database connection
require_once 'conexao.php';
$con->set_charset("utf8");

// Get JSON input
$jsonParam = json_decode(file_get_contents('php://input'), true);

if (!$jsonParam) {
    echo json_encode(['success' => false, 'message' => 'Dados JSON inválidos ou ausentes.']);
    exit;
}

// Extract and validate data
$nmPaciente     = trim($jsonParam['nmPaciente'] ?? '');
$dtnascPaciente = trim($jsonParam['dtnascPaciente'] ?? '');
$sxPaciente     = trim($jsonParam['sxPaciente'] ?? '');
$jdPaciente     = trim($jsonParam['jdPaciente'] ?? '');
$udPaciente     = trim($jsonParam['udPaciente'] ?? '');
$tsPaciente     = trim($jsonParam['tsPaciente'] ?? '');



// Prepare statement
$stmt = $con->prepare("
    INSERT INTO cadPaciente.cpaPaciente 
    (nmPaciente, dtnascPaciente, sxPaciente, jdPaciente, udPaciente, tsPaciente)
    VALUES ( ?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Erro ao preparar a consulta: ' . $con->error]);
    exit;
}

// Bind parameters
$stmt->bind_param("ssssss", 
    $nmPaciente, $dtnascPaciente, 
    $sxPaciente, $jdPaciente, $udPaciente, $tsPaciente
);

// Execute and return result
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Paciente inserido com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao inserir paciente: ' . $stmt->error]);
}

$stmt->close();
$con->close();

?>
