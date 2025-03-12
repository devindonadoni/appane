<?php
header('Content-Type: application/json');
include '../config/database.php';
session_start(); // Avvia la sessione per ottenere l'idCliente


$data = json_decode(file_get_contents('php://input'), associative: true);
// Controllo dati ricevuti
if (!isset($data['idCliente'])) {
    echo json_encode(value: ["success" => false, "message" => "Dati incompleti"]);
    exit;
}

$idCliente = $data['idCliente']; // Assicurati che questa variabile sia impostata correttamente

try {
    // Avvia una transazione per garantire l'integrità dei dati
    $db_remoto->begin_transaction();

    // 1) Trova idIndirizzo default
    $query = "SELECT idIndirizzo FROM tordine WHERE idCliente = ? AND idStato = ?";
    $stmt = $db_remoto->prepare($query);

    // Usa variabili per bind_param
    $idStato = 1; // Definisci la variabile per idStato
    $stmt->bind_param("ii", $idCliente, $idStato); // Passa variabili, non valori letterali
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idIndirizzo = $row['idIndirizzo'];

        // 2) Trova i dettagli dell'indirizzo in tindirizzo
        $query_indirizzo = "SELECT via, numeroCivico, interno FROM tindirizzo WHERE idIndirizzo = ?";
        $stmt_indirizzo = $db_remoto->prepare($query_indirizzo);
        $stmt_indirizzo->bind_param("i", $idIndirizzo); // Passa l'idIndirizzo trovato
        $stmt_indirizzo->execute();
        $result_indirizzo = $stmt_indirizzo->get_result();

        if ($result_indirizzo->num_rows > 0) {
            $row_indirizzo = $result_indirizzo->fetch_assoc();
            $via = $row_indirizzo['via'];
            $numeroCivico = $row_indirizzo['numeroCivico'];
            $interno = $row_indirizzo['interno'];

            // Restituisci i dettagli dell'indirizzo
            echo json_encode([
                "success" => true,
                "idIndirizzo" => $idIndirizzo,
                "via" => $via,
                "numeroCivico" => $numeroCivico,
                "interno" => $interno
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Nessun dettaglio trovato per l'indirizzo specificato"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Nessun indirizzo trovato per il cliente"]);
    }

    // Conferma la transazione
    $db_remoto->commit();
} catch (Exception $e) {
    $db_remoto->rollback(); // Annulla tutte le operazioni in caso di errore
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}

// Chiudi la connessione al database
$db_remoto->close();
?>