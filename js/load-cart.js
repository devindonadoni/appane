function caricaCarrello() {
    $.ajax({
        url: 'api/prodotti/cart-query.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log("Risposta API:", data);  // <-- Aggiunto per debugging
            $("#carrello-container").empty();

            if (data.length === 0) {
                // Se l'array è vuoto, mostra il messaggio
                $("#carrello-container").html("<div class='no-items-container'><p>Nessun articolo disponibile nel carrello. <a href='menu.php'>Torna allo shop</a></p></div>");
                $("#checkout-container").css("display", "none");
                return;
            }

            let totale = 0;
            let commissioni = 0;

            data.forEach(function (item) {
                const itemHTML = 
                    `<div class="item-container" id="item-${item.idOrdine}">
                        <div class="container-img">
                            <div class="concert-info">
                                <h1>${item.nomeProdotto}</h1>
                            </div>
                        </div>
                        <div class="timer-container">
                            <p id="timer-${item.idOrdine}">Caricando...</p>
                        </div>
                        <div class="posto-container">
                            <p>${item.peso}</p>
                        </div>
                        <div class="price-container">
                            <p>€${item.prezzo}</p>
                            <i class="fa-solid fa-trash-can" onclick="rimuoviElemento(${item.idOrdine})"></i>
                        </div>
                    </div>`;

                $("#carrello-container").append(itemHTML);

                totale += parseFloat(item.prezzo);
                commissioni += parseFloat(item.prezzo) * 0.1;

                // Calcola il tempo rimanente fino alla fine della giornata
                const dataOrdine = new Date(item.dataOrdine);  // data dell'ordine
                const fineGiornata = new Date(dataOrdine.setHours(23, 59, 59, 999));  // Imposta l'orario a 23:59:59
                const oraCorrente = new Date();
                let tempoRimanente = fineGiornata.getTime() - oraCorrente.getTime();

                (function startTimer(idOrdine, tempoRimanente) {
                    function aggiornaTimer() {
                        if (tempoRimanente <= 0) {
                            clearInterval(timerInterval);
                            $("#timer-" + idOrdine).text("EXPIRED");
                            Swal.fire({
                                title: "Prenotazione Scaduta!",
                                text: "La tua prenotazione è scaduta e verrà rimossa.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            }).then(() => {
                                rimuoviElementoExpired(idOrdine);
                            });
                        } else {
                            const ore = Math.floor(tempoRimanente / (1000 * 60 * 60));
                            const minuti = Math.floor((tempoRimanente % (1000 * 60 * 60)) / (1000 * 60));
                            const secondi = Math.floor((tempoRimanente % (1000 * 60)) / 1000);
                            $("#timer-" + idOrdine).text(`${ore}h ${minuti}m ${secondi}s`);
                        }

                        if (tempoRimanente <= 60 * 60 * 1000) {  // 60 minuti * 60 secondi * 1000 millisecondi
                            $("#timer-" + idOrdine).css("background-color", "red");
                        } else {
                            $("#timer-" + idOrdine).css("background-color", ""); // Ripristina lo sfondo
                        }
                        tempoRimanente -= 1000;
                    }

                    const timerInterval = setInterval(aggiornaTimer, 1000);
                    aggiornaTimer();
                })(item.idOrdine, tempoRimanente);  // Usa item.idOrdine per il timer
            });

            $("#totale").text(`€${totale.toFixed(2)}`);
            $("#commissioni").text(`€${commissioni.toFixed(2)}`);
            $("#grantotale").text(`€${(totale + commissioni).toFixed(2)}`);
        },
        error: function (xhr, status, error) {
            console.log("Errore nel caricare i dati del carrello", xhr.responseText);
        }
    });
}