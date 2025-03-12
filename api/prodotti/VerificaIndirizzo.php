<?php
header('Content-Type: application/json');
include '../config/database.php';

// Recupera i dati dalla richiesta JSON
$data = json_decode(file_get_contents("php://input"), true);

//Controlla se i dati sono presenti
if (!isset($data['via']) || !isset($data['numeroCivico'])) {
    echo json_encode(['success' => false, 'message' => 'Dati incompleti']);
    exit;
}

$via = $data['via'];
$numeroCivico = $data['numeroCivico'];
$interno = isset($data['interno']) ? $data['interno'] : '';

// Prepara la query per verificare se l'indirizzo esiste già
$sql = "SELECT idIndirizzo FROM tIndirizzo WHERE via = ? AND numeroCivico = ? AND interno = ?";
$stmt = $db_remoto->prepare($sql);
$stmt->bind_param("sss", $via, $numeroCivico, $interno);
$stmt->execute();
$result = $stmt->get_result();

// Se l'indirizzo esiste già, restituisci il suo ID
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idIndirizzo = $row['idIndirizzo'];
    echo json_encode(['success' => true, 'idIndirizzo' => $idIndirizzo]);
} else {
    // Se l'indirizzo non esiste, inseriscilo nel data
    $sql = "INSERT INTO tIndirizzo (cap, via, numeroCivico, interno) VALUES (?, ?, ?, ?)";
    $stmt = $db_remoto->prepare($sql);
    $stmt->bind_param("ssss", $cap, $via, $numeroCivico, $interno);

    // Imposta il valore del CAP (supponiamo che sia recuperato tramite qualche logica)
    // Ad esempio, puoi fare una ricerca del CAP in base alla via e al numero civico.
    $cap = "00000"; // Modifica con la logica per ottenere il CAP

    if ($stmt->execute()) {
        $idIndirizzo = $stmt->insert_id;
        echo json_encode(['success' => true, 'idIndirizzo' => $idIndirizzo]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore nell\'inserimento dell\'indirizzo']);
    }
}

// Chiudi la db_remotoessione
$stmt->close();
$db_remoto->close();
?>
