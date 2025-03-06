<?php
header('Content-Type: application/json');

include $_SERVER['DOCUMENT_ROOT'] . '/appane/api/config/database.php';

// 1) Trova l'ultimo menu inserito
$query_menu = "SELECT idMenu FROM tmenu ORDER BY ultimaDataPubblicazione DESC LIMIT 1";
$result_menu = mysqli_query($db_remoto, $query_menu);
if (!$result_menu || mysqli_num_rows($result_menu) == 0) {
    echo json_encode(["error" => "Nessun menu trovato"]);
    exit;
}
$menu = mysqli_fetch_assoc($result_menu);
$idMenu = $menu['idMenu'];

// 2) Trova gli idProdotto associati all'idMenu
$query_prodotti = "SELECT idProdotto FROM tsceltaprodotti WHERE idMenu = $idMenu";
$result_prodotti = mysqli_query($db_remoto, $query_prodotti);
$prodotti = [];
while ($row = mysqli_fetch_assoc($result_prodotti)) {
    $prodotti[] = $row['idProdotto'];
}
if (empty($prodotti)) {
    echo json_encode(["error" => "Nessun prodotto associato a questo menu"]);
    exit;
}
$idProdotti = implode(",", $prodotti);

// 3) Prendi i dati dei prodotti e le tipologie
$query_dati_prodotti = "SELECT p.idProdotto, p.nome, p.peso, p.prezzo, p.quantita, t.nome AS tipologia 
                        FROM tprodotto p 
                        JOIN ttipologia t ON p.idTipologia = t.idTipologia
                        WHERE p.idProdotto IN ($idProdotti)";
$result_dati_prodotti = mysqli_query($db_remoto, $query_dati_prodotti);
$prodotti_dati = [];
while ($row = mysqli_fetch_assoc($result_dati_prodotti)) {
    $prodotti_dati[$row['idProdotto']] = $row;
    $prodotti_dati[$row['idProdotto']]['ingredienti'] = [];
    $prodotti_dati[$row['idProdotto']]['foto'] = [];
    $prodotti_dati[$row['idProdotto']]['allergeni'] = [];
}

// 4) Trova gli ingredienti per ogni prodotto
$query_ingredienti = "SELECT r.idProdotto, i.nome AS ingrediente 
                      FROM tricetta r 
                      JOIN tingrediente i ON r.idIngrediente = i.idIngrediente
                      WHERE r.idProdotto IN ($idProdotti)";
$result_ingredienti = mysqli_query($db_remoto, $query_ingredienti);
while ($row = mysqli_fetch_assoc($result_ingredienti)) {
    $prodotti_dati[$row['idProdotto']]['ingredienti'][] = $row['ingrediente'];
}

// 5) Trova le foto per ogni prodotto
$query_foto = "SELECT idProdotto, pathFoto FROM tfoto WHERE idProdotto IN ($idProdotti)";
$result_foto = mysqli_query($db_remoto, $query_foto);
while ($row = mysqli_fetch_assoc($result_foto)) {
    $prodotti_dati[$row['idProdotto']]['foto'][] = $row['pathFoto'];
}

// 6) Trova gli allergeni per ogni ingrediente
$query_allergeni = "SELECT pa.idIngrediente, a.nome AS allergene 
                    FROM tpresenzaallergene pa 
                    JOIN tallergene a ON pa.idAllergene = a.idAllergene
                    WHERE pa.idIngrediente IN (SELECT idIngrediente FROM tricetta WHERE idProdotto IN ($idProdotti))";
$result_allergeni = mysqli_query($db_remoto, $query_allergeni);
while ($row = mysqli_fetch_assoc($result_allergeni)) {
    foreach ($prodotti_dati as &$prodotto) {
        if (in_array($row['idIngrediente'], $prodotti_dati[$prodotto['idProdotto']]['ingredienti'])) {
            $prodotto['allergeni'][] = $row['allergene'];
        }
    }
}

// Aggiungi idMenu ad ogni prodotto
foreach ($prodotti_dati as &$prodotto) {
    $prodotto['idMenu'] = $idMenu;
}

// Risultato finale in JSON
echo json_encode(array_values($prodotti_dati), JSON_PRETTY_PRINT);

mysqli_close($db_remoto);
?>
