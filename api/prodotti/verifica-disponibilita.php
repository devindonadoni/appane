<?php
header('Content-Type: application/json');

include '../config/database.php';

// Recupero dei dati dalla richiesta GET (nel tuo caso saranno passati come query string)
$data = json_decode(file_get_contents('php://input'), true);

// Verifica che tutti i parametri necessari siano presenti
if (!isset($data['idProdotto']) || !isset($data['quantita'])) {
    echo json_encode(["success" => false, "message" => "Parametri mancanti"]);
    exit;
}

$idProdotto = $data['idProdotto'];
$quantitaRichiesta = $data['quantita'];

// 1) Verifica la disponibilità del prodotto nel database
$query = "SELECT quantita FROM tprodotto WHERE idProdotto = ?";
$stmt = mysqli_prepare($db_remoto, $query);
mysqli_stmt_bind_param($stmt, "i", $idProdotto);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo json_encode(["success" => false, "message" => "Prodotto non trovato"]);
    exit;
}

$prodotto = mysqli_fetch_assoc($result);
$quantitaDisponibile = $prodotto['quantita'];

// 2) Verifica che la quantità richiesta sia disponibile
if ($quantitaRichiesta <= $quantitaDisponibile) {
    echo json_encode(["success" => true, "message" => "I prodotti sono disponibili."]);
} else {
    echo json_encode(["success" => false, "message" => "Quantità richiesta non disponibile"]);
}

// Chiudo la connessione al database
mysqli_close($db_remoto);
?>
