<?php
header('Content-Type: application/json');
include '../config/database.php';

session_start();

if (!isset($_SESSION['idCliente'])) {
    echo json_encode(["error" => "ID cliente mancante"]);
    exit;
}

$idCliente = $_SESSION['idCliente'];

$query = "
    SELECT o.idOrdine, o.dataOrdine, p.nome AS nomeProdotto, p.peso, p.prezzo 
    FROM tordine o
    JOIN tsceltaProdotti
 s ON o.idScelta = s.idScelta
    JOIN tprodotto p ON s.idProdotto = p.idProdotto
    WHERE o.idCliente = ? AND o.idStato = 1
";

$stmt = $db_remoto->prepare($query);
$stmt->bind_param("i", $idCliente);
$stmt->execute();
$result = $stmt->get_result();

$ordini = [];
while ($row = $result->fetch_assoc()) {
    $ordini[] = $row;
}

$stmt->close();
$db_remoto->close();

echo json_encode($ordini);


?>