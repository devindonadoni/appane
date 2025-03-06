<?php
include $_SERVER['DOCUMENT_ROOT'] . '/appane/api/config/database.php';

header('Content-Type: application/json');

// Connessione al database

// 1) Verifica che l'idProdotto sia stato passato tramite POST
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['idProdotto']) || !is_numeric($data['idProdotto'])) {
    echo json_encode(["error" => "ID Prodotto non valido"]);
    exit;
}

$idProdotto = (int)$data['idProdotto'];

// 2) Prendi i dati del prodotto e le tipologie
$query_dati_prodotto = "SELECT p.idProdotto, p.nome, p.peso, p.prezzo, p.descrizione, t.nome AS tipologia 
                        FROM tprodotto p 
                        JOIN ttipologia t ON p.idTipologia = t.idTipologia
                        WHERE p.idProdotto = $idProdotto";
$result_dati_prodotto = mysqli_query($db_remoto, $query_dati_prodotto);
if (!$result_dati_prodotto || mysqli_num_rows($result_dati_prodotto) == 0) {
    echo json_encode(["error" => "Prodotto non trovato"]);
    exit;
}
$prodotto = mysqli_fetch_assoc($result_dati_prodotto);
$prodotto['ingredienti'] = [];
$prodotto['foto'] = [];
$prodotto['allergeni'] = [];

// 3) Trova gli ingredienti per il prodotto
$query_ingredienti = "SELECT i.nome AS ingrediente 
                      FROM tricetta r 
                      JOIN tingrediente i ON r.idIngrediente = i.idIngrediente
                      WHERE r.idProdotto = $idProdotto";
$result_ingredienti = mysqli_query($db_remoto, $query_ingredienti);
while ($row = mysqli_fetch_assoc($result_ingredienti)) {
    $prodotto['ingredienti'][] = $row['ingrediente'];
}

// 4) Trova le foto per il prodotto
$query_foto = "SELECT pathFoto FROM tfoto WHERE idProdotto = $idProdotto";
$result_foto = mysqli_query($db_remoto, $query_foto);
while ($row = mysqli_fetch_assoc($result_foto)) {
    $prodotto['foto'][] = $row['pathFoto'];
}

// 5) Trova gli allergeni per gli ingredienti del prodotto
$query_allergeni = "SELECT a.nome AS allergene 
                    FROM tpresenzaallergene pa 
                    JOIN tallergene a ON pa.idAllergene = a.idAllergene
                    WHERE pa.idIngrediente IN (SELECT idIngrediente FROM tricetta WHERE idProdotto = $idProdotto)";
$result_allergeni = mysqli_query($db_remoto, $query_allergeni);
while ($row = mysqli_fetch_assoc($result_allergeni)) {
    $prodotto['allergeni'][] = $row['allergene'];
}

// Risultato finale in JSON
echo json_encode($prodotto, JSON_PRETTY_PRINT);

mysqli_close($db_remoto); 
?>
