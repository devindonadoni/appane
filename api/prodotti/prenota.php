<?php
header('Content-Type: application/json');
session_start(); // Avvia la sessione per ottenere l'idCliente

// Verifica se l'utente è autenticato
if (!isset($_SESSION['idCliente'])) {
    echo json_encode(["success" => false, "message" => "Utente non autenticato"]);
    exit;
}

$idCliente = $_SESSION['idCliente'];

// Leggi i dati dalla richiesta AJAX
$data = json_decode(file_get_contents('php://input'), associative: true);



// Controllo dati ricevuti
if (!isset($data['idMenu'], $data['idProdotto'], $data['quantita'])) {
    echo json_encode(["success" => false, "message" => "Dati incompleti"]);
    exit;
}

$idMenu = $data['idMenu'];
$idProdotto = $data['idProdotto'];
$quantita = intval($data['quantita']); // Assicura che sia un numero intero positivo

// db_remotoessione al database
include $_SERVER['DOCUMENT_ROOT'] . '/appane/api/config/database.php';

if (!$db_remoto) {
    echo json_encode(["success" => false, "message" => "Errore di db_remotoessione al database"]);
    exit;
}

try {
    // Avvia una transazione per garantire l'integrità dei dati
    $db_remoto->begin_transaction();

    // 1) Trova l'idScelta nella tabella tsceltaprodotti
    $query = "SELECT idScelta FROM tsceltaprodotti WHERE idMenu = ? AND idProdotto = ?";
    $stmt = $db_remoto->prepare($query);
    $stmt->bind_param("ii", $idMenu, $idProdotto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception("Scelta non trovata per i parametri forniti");
    }

    $row = $result->fetch_assoc();
    $idScelta = $row['idScelta'];
    $stmt->close();

    // 2) Trova l'idIndirizzo nella tabella tcliente
    $query = "SELECT idIndirizzo FROM tcliente WHERE idCliente = ?";
    $stmt = $db_remoto->prepare($query);
    $stmt->bind_param("i", $idCliente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception("Cliente non trovato");
    }

    $row = $result->fetch_assoc();
    $idIndirizzo = $row['idIndirizzo'];
    $stmt->close();

    // 3) Esegui gli ordini in base alla quantità richiesta
    $query = "INSERT INTO tordine (idCliente, idScelta, note, dataOrdine, idStato, idIndirizzo) 
              VALUES (?, ?, ?, NOW(), 1, ?)";
    $stmt = $db_remoto->prepare($query);
    
    $nota = "Ordine automatico"; // Nota generica, puoi modificarla o renderla dinamica

    for ($i = 0; $i < $quantita; $i++) {
        $stmt->bind_param("iisi", $idCliente, $idScelta, $nota, $idIndirizzo);
        $stmt->execute();
    }
    $stmt->close();

    // 4) Aggiorna la quantità del prodotto nella tabella tprodotto
    $query = "UPDATE tprodotto SET quantita = quantita - ? WHERE idProdotto = ? AND quantita >= ?";
    $stmt = $db_remoto->prepare($query);
    $stmt->bind_param("iii", $quantita, $idProdotto, $quantita);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        throw new Exception("Quantità insufficiente per completare l'ordine");
    }

    // Conferma la transazione
    $db_remoto->commit();

    echo json_encode(["success" => true, "message" => "Ordine effettuato con successo"]);
} catch (Exception $e) {
    $db_remoto->rollback(); // Annulla tutte le operazioni in caso di errore
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}

// Chiudi la db_remotoessione
$db_remoto->close();
?>
