









function rimuoviElementoExpired(idOrdine) {
    $.ajax({
        url: 'api/prodotti/rimuovi-ordini.php',
        method: "POST",
        contentType: 'application/json',
        data: JSON.stringify({ idOrdine: idOrdine }),
        success: function (response) {
            console.log(response);
            if (response.success) {
                // Rimuove l'elemento dal carrello visibile
                $(`#item-${idOrdine}`).remove();

                // Ricarica i totali
                let totale = 0;

                $(".item-container").each(function () {
                    let prezzo = parseFloat($(this).find('.price-container p').text().replace("€", ""));
                    totale += prezzo;
                    commissioni += prezzo * 0.1;
                });

                $("#totale").text(`€${totale.toFixed(2)}`);
                $("#commissioni").text(`€${commissioni.toFixed(2)}`);
                $("#grantotale").text(`€${(totale + commissioni).toFixed(2)}`);

                if ($(".item-container").length === 0) {
                    $("#carrello-container").html("<div class='no-items-container'><p>Nessun articolo disponibile nel carrello. Torna allo shop</p></div>");
                    $("#checkout-container").css("display", "none");
                }

                console.log(`Prenotazione con ID ${idOrdine} eliminata automaticamente dopo la scadenza del timer.`);
            } else {
                console.log(`Errore: impossibile eliminare la prenotazione con ID ${idOrdine}.`);
            }
        },
        error: function (xhr, status, error) {
            console.log("Errore nella richiesta AJAX", xhr.responseText);
        }
    });
}


// Funzione per rimuovere un elemento dal carrello con SweetAlert2
function rimuoviElemento(idOrdine) {
    const tempoRimanente = $(`#timer-${idOrdine}`).text(); // Ottieni il tempo rimanente dal timer

    Swal.fire({
        title: 'Sei sicuro?',
        text: `Hai ancora ${tempoRimanente} per decidere. Questa azione rimuoverà la prenotazione dal carrello.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sì, elimina!',
        cancelButtonText: 'Annulla',
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("idOrdine: " + idOrdine);
            $.ajax({
                url: 'api/prodotti/rimuovi-ordini.php',
                method: "POST",
                contentType: 'application/json',
                data: JSON.stringify({ idOrdine: idOrdine }),
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        // Rimuove l'elemento dal carrello visibile
                        $(`#item-${idOrdine}`).remove();

                        // Ricarica i totali
                        let totale = 0;
                        let commissioni = 0;

                        $(".item-container").each(function () {
                            let prezzo = parseFloat($(this).find('.price-container p').text().replace("€", ""));
                            totale += prezzo;
                            commissioni += prezzo * 0.1;
                        });

                        $("#totale").text(`€${totale.toFixed(2)}`);
                        $("#commissioni").text(`€${commissioni.toFixed(2)}`);
                        $("#grantotale").text(`€${(totale + commissioni).toFixed(2)}`);

                        if ($(".item-container").length === 0) {
                            $("#carrello-container").html("<div class='no-items-container'><p>Nessun articolo disponibile nel carrello. Torna allo shop</p></div>");
                            $("#checkout-container").css("display", "none");
                        }

                        Swal.fire(
                            'Eliminato!',
                            'La prenotazione è stata rimossa dal carrello.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Errore',
                            'Non è stato possibile eliminare la prenotazione.',
                            'error'
                        );
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Errore nella richiesta AJAX", xhr.responseText);
                    Swal.fire(
                        'Errore',
                        'Si è verificato un errore durante l\'eliminazione.',
                        'error'
                    );
                }
            });
        }
    });
}