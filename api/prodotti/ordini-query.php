<?php
header('Content-Type: application/json');

include '../config/database.php';
session_start();

// Verifica se l'utente è loggato e se l'idCliente è presente nella sessione
if (!isset($_SESSION['idCliente'])) {
    http_response_code(401); // Non autorizzato
    echo json_encode(["error" => "Utente non autenticato"]);
    exit;
}

// Recupera l'idCliente dalla sessione
$idCliente = $_SESSION['idCliente'];

try {
    // Query per recuperare gli ordini dell'utente
    $query = "
        SELECT 
            o.idOrdine,
            o.dataOrdine,
            o.idScelta,
            o.idIndirizzo,
            o.idStato,
            s.idProdotto,
            p.nome AS nomeProdotto,
            p.peso,
            p.prezzo,
            st.statoOrdine,
            i.via,
            i.numeroCivico
        FROM tordine o
        LEFT JOIN tsceltaProdotti
 s ON o.idScelta = s.idScelta
        LEFT JOIN tprodotto p ON s.idProdotto = p.idProdotto
        LEFT JOIN tstatoordine st ON o.idStato = st.idStato
        LEFT JOIN tindirizzo i ON o.idIndirizzo = i.idIndirizzo
        WHERE o.idCliente = ?
    ";

    // Prepara e esegui la query con MySQLi
    $stmt = $db_remoto->prepare($query);
    if (!$stmt) {
        throw new Exception("Errore nella preparazione della query: " . $db_remoto->error);
    }
    
    $stmt->bind_param("i", $idCliente);
    
    if (!$stmt->execute()) {
        throw new Exception("Errore nell'esecuzione della query: " . $stmt->error);
    }

    $result = $stmt->get_result();
    
    // Recupera i risultati
    $ordini = $result->fetch_all(MYSQLI_ASSOC);

    // Formatta i risultati
    $response = [];
    foreach ($ordini as $ordine) {
        $response[] = [
            'idOrdine' => $ordine['idOrdine'],
            'dataOrdine' => $ordine['dataOrdine'],
            'nomeProdotto' => $ordine['nomeProdotto'],
            'peso' => $ordine['peso'],
            'prezzo' => $ordine['prezzo'],
            'statoPrenotazione' => $ordine['statoOrdine'], // Formattato come richiesto
            'via' => $ordine['via'],
            'numeroCivico' => $ordine['numeroCivico']
        ];
    }

    // Restituisci i risultati in formato JSON
    echo json_encode($response);

} catch (Exception $e) {
    // Gestione degli errori
    http_response_code(500); // Errore del server
    echo json_encode(["error" => "Errore del server: " . $e->getMessage()]);
}
?>
