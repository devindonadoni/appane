$(document).ready(function () {
    const apiUrl = 'api/prodotti/ordini-query.php';

    function loadPrenotazioni(statoPrenotazione = null, ordine = 'asc', filtro = 'nomeProdotto') {
        $.ajax({
            url: apiUrl,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Filtra le prenotazioni in base allo stato
                let filteredData = statoPrenotazione
                    ? data.filter(prenotazione => prenotazione.statoPrenotazione === statoPrenotazione)
                    : data;

                // Ordina i dati in base al filtro selezionato
                filteredData.sort((a, b) => {
                    if (ordine === 'asc') {
                        return a[filtro].localeCompare(b[filtro]);
                    } else {
                        return b[filtro].localeCompare(a[filtro]);
                    }
                });

                let html = filteredData.length === 0
                    ? `<div class="no-booking">
                    <p>Nessuna prenotazione disponibile.</p>
                    <a href="shop.html" class="shop-link">Torna allo shopping</a>
                    </div>`
                                    : filteredData.map(prenotazione => `
                        <div class="event-info">
                            <h1>${prenotazione.nomeProdotto}</h1>
                            <p>${prenotazione.via} | ${prenotazione.numeroCivico}</p>
                            <p>${prenotazione.dataOrdine}</p>
                            <p>${prenotazione.peso}</p>
                            <div class="total">
                                <p style="color: white; background-color: ${getColor(prenotazione.statoPrenotazione)};">
                                    €${prenotazione.prezzo}, ${prenotazione.statoPrenotazione}
                                </p>
                                
                            </div>
                        </div>
                `).join('');



                // Inserisce i dati nel tab corretto
                switch (statoPrenotazione) {
                    case null:
                        $('#item1 .container-event').html(html);
                        break;
                    case 'confermato':
                        $('#item2 .container-event').html(html);
                        break;
                    case 'cancellato':
                        $('#item3 .container-event').html(html);
                        break;
                    case 'in elaborazione':
                        $('#item4 .container-event').html(html);
                        break;
                }
            },
            error: function (xhr, status, error) {
                console.error("Errore nel caricamento dati:", error);
            }
        });
    }

    // Carica prenotazioni iniziali per tutti i tab
    loadPrenotazioni(null); // Tutte
    loadPrenotazioni('confermato'); // Pagate
    loadPrenotazioni('cancellato'); // Cancellate
    loadPrenotazioni('in elaborazione'); // Scadute

    function getColor(statoPrenotazione) {
        switch (statoPrenotazione) {
            case 'confermato': return 'green';
            case 'cancellato': return 'red';
            case 'in elaborazione': return 'orange';
            default: return 'gray';
        }
    }

    let filtriStato = {
        'evento': { campo: 'nomeEvento', ordine: 'asc' },
        'luogo': { campo: 'citta', ordine: 'asc' },
        'data': { campo: 'dataOraEvento', ordine: 'asc' },
        'posto': { campo: 'numeroPosto', ordine: 'asc' },
        'prezzo': { campo: 'prezzo', ordine: 'asc' }
    };


    $(".single-filter").click(function () {
        let filtroSelezionato = $(this).text().trim().toLowerCase(); // "Evento" → "evento"
        let filtro = filtriStato[filtroSelezionato];

        if (filtro) {
            // Invertiamo l'ordine ad ogni click
            filtro.ordine = filtro.ordine === 'asc' ? 'desc' : 'asc';

            // Troviamo il tab attivo
            let tabAttivo = $(".tab-item a.active").attr("href").replace("#", "");

            // Carichiamo le prenotazioni ordinate per il tab attivo
            switch (tabAttivo) {
                case "item1":
                    loadPrenotazioni(null, filtro.ordine, filtro.campo);
                    break;
                case "item2":
                    loadPrenotazioni("confermato", filtro.ordine, filtro.campo);
                    break;
                case "item3":
                    loadPrenotazioni("cancellato", filtro.ordine, filtro.campo);
                    break;
                case "item4":
                    loadPrenotazioni("in elaborazione", filtro.ordine, filtro.campo);
                    break;
            }
        }
    });

});
