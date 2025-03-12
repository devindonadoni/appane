<?php
header("Content-Type: application/json");

include '../config/database.php';


// Verifica che la richiesta sia POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($data['idCliente']) || !isset($data['idIndirizzo'])) {
        echo json_encode(["success" => false, "message" => "Parametri mancanti"]);
        exit;
    }

    $idCliente = intval($data['idCliente']);
    $idIndirizzo = intval($data['idIndirizzo']);
    
    $sql = "UPDATE tordine SET idStato = 3, note = 'ordine confermato', idIndirizzo = ? WHERE idCliente = ? AND idStato = 1";
    
    $stmt = $db_remoto->prepare($sql);
    $stmt->bind_param("ii", $idIndirizzo, $idCliente);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Ordini aggiornati con successo"]);
    } else {
        echo json_encode(["success" => false, "message" => "Errore nell'aggiornamento: " . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Metodo non consentito"]);
}

$db_remoto->close();
?>