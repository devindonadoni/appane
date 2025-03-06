function getProdotto(idProdotto) {
    $.ajax({
        url: 'api/prodotti/prodotto.php',  
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ idProdotto: idProdotto }),
        success: function (response) {
            if (response.error) {
                Swal.fire({
                    title: "Errore",
                    text: "Prodotto non trovato",
                    icon: "error",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "menu.php";
                    }
                });
            } else {
                console.log(response);
                let output = '';

                // Creazione del carosello dinamico con le immagini del prodotto
                let carouselItems = '';
                let indicators = '';

                if (response.foto.length > 0) {
                    response.foto.forEach((foto, index) => {
                        carouselItems += `
                            <div class="carousel-item ${index === 0 ? 'active' : ''}" 
                                style="background-image: url('${foto}');"></div>`;
                        indicators += `
                            <span class="indicator ${index === 0 ? 'active' : ''}" 
                                onclick="goToSlide(event, ${idProdotto}, ${index})"></span>`;
                    });
                } else {
                    // Immagine di default se il prodotto non ha foto
                    carouselItems = `<div class="carousel-item active" 
                                     style="background-image: url('img/stock/produzione.png');"></div>`;
                    indicators = `<span class="indicator active" onclick="goToSlide(event, ${idProdotto}, 0)"></span>`;
                }

                output += `
                    <div class="carousel" data-carousel-id="${idProdotto}">
                        <div class="carousel-inner">${carouselItems}</div>
                        <button class="carousel-control-prev" onclick="prevSlide(event, ${idProdotto})">&#10094;</button>
                        <button class="carousel-control-next" onclick="nextSlide(event, ${idProdotto})">&#10095;</button>
                        <div class="carousel-indicators">${indicators}</div>
                        <h1 class="carousel-title">${response.nome}</h1>
                    </div>

                    <div class="descrizione">
                        <div class="left-side">
                            <p>${response.descrizione}.</p>
                            <div class="info">
                                <p>Quantità al pezzo: ${response.peso}g</p>
                                <p>Prezzo al pezzo: €${response.prezzo}</p>
                            </div>
                        </div>

                        <ul class="allergeni">
                            ${response.allergeni.map(allergene => `<li>● ${allergene}</li>`).join('')}
                        </ul>
                    </div>
                `;

                document.getElementById('prodotto-content').innerHTML = output;

                // Rilancia il carousel una volta che è stato generato il nuovo HTML
                setTimeout(() => {
                    initializeCarousel(idProdotto);
                }, 100);
            }
        },
        error: function (xhr, status, error) {
            console.log("Errore nella richiesta AJAX", xhr.responseText);
            Swal.fire('Errore', 'Si è verificato un errore durante il recupero dei dettagli del prodotto.', 'error');
        }
    });
}
