<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/appane/api/config/database.php';

header("Content-Type: application/json");



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['idOrdine']) || !is_numeric($data['idOrdine'])) {
        echo json_encode(["success" => false, "message" => "ID ordine non valido"]);
        exit;
    }

    $idOrdine = $data['idOrdine'];

    try {
        // Aggiorna la nota e lo stato dell'ordine
        $sqlOrdine = "UPDATE tordine SET note = 'ordine cancellato', idStato = 2 WHERE idOrdine = ?";
        $stmtOrdine = mysqli_prepare($db_remoto, $sqlOrdine);
        mysqli_stmt_bind_param($stmtOrdine, "i", $idOrdine);
        mysqli_stmt_execute($stmtOrdine);

        // Trova l'idScelta associato all'ordine
        $sqlScelta = "SELECT idScelta FROM tordine WHERE idOrdine = ?";
        $stmtScelta = mysqli_prepare($db_remoto, $sqlScelta);
        mysqli_stmt_bind_param($stmtScelta, "i", $idOrdine);
        mysqli_stmt_execute($stmtScelta);
        $resultScelta = mysqli_stmt_get_result($stmtScelta);
        $scelta = mysqli_fetch_assoc($resultScelta);

        if ($scelta) {
            $idScelta = $scelta['idScelta'];

            // Trova l'idProdotto associato alla scelta
            $sqlProdotto = "SELECT idProdotto FROM tsceltaprodotti WHERE idScelta = ?";
            $stmtProdotto = mysqli_prepare($db_remoto, $sqlProdotto);
            mysqli_stmt_bind_param($stmtProdotto, "i", $idScelta);
            mysqli_stmt_execute($stmtProdotto);
            $resultProdotto = mysqli_stmt_get_result($stmtProdotto);
            $prodotto = mysqli_fetch_assoc($resultProdotto);

            if ($prodotto) {
                $idProdotto = $prodotto['idProdotto'];

                // Incrementa la quantità del prodotto
                $sqlUpdateProdotto = "UPDATE tprodotto SET quantita = quantita + 1 WHERE idProdotto = ?";
                $stmtUpdateProdotto = mysqli_prepare($db_remoto, $sqlUpdateProdotto);
                mysqli_stmt_bind_param($stmtUpdateProdotto, "i", $idProdotto);
                mysqli_stmt_execute($stmtUpdateProdotto);
            }
        }

        echo json_encode(["success" => true, "message" => "Ordine cancellato con successo"]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Errore durante la cancellazione dell'ordine", "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metodo non supportato"]);
}
?>
