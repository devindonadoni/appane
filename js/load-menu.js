function getMenu() {
    $.ajax({
        url: 'api/prodotti/menu-query.php',  
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log('Risposta dell\'API:', response); // Verifica la risposta

            // Aggiungi un controllo per verificare che response sia un array
            if (!Array.isArray(response)) {
                Swal.fire('Errore', 'Impossibile recuperare il menu.', 'error');
                return;
            }

            let output = '';

            response.forEach(prodotto => {
                let carouselItems = '';
                let indicators = '';
                let soldoutOverlay = prodotto.quantita === 0 ? '<div class="soldout-overlay">SOLD OUT</div>' : '';

                if (Array.isArray(prodotto.foto) && prodotto.foto.length > 0) {
                    prodotto.foto.forEach((foto, index) => {
                        carouselItems += `
                            <div class="carousel-item ${index === 0 ? 'active' : ''}" 
                                style="background-image: url('${foto}');"></div>`;
                        indicators += `
                            <span class="indicator ${index === 0 ? 'active' : ''}" 
                                onclick="goToSlide(event, ${prodotto.idProdotto}, ${index})"></span>`;
                    });
                } else {
                    carouselItems = `<div class="carousel-item active" 
                                     style="background-image: url('img/stock/produzione.png');"></div>`;
                    indicators = `<span class="indicator active" onclick="goToSlide(event, ${prodotto.idProdotto}, 0)"></span>`;
                }

                output += `
                <div class="single-product" onclick="reindirizza('prodotto-view', 'idProdotto=${prodotto.idProdotto}' , 'idMenu=${prodotto.idMenu}')">
                        ${soldoutOverlay}  <!-- Overlay soldout condizionato dalla quantità -->
                        <div class="carousel" data-carousel-id="${prodotto.idProdotto}">
                            <div class="carousel-inner">${carouselItems}</div>
                            <button class="carousel-control-prev" onclick="prevSlide(event, ${prodotto.idProdotto})">&#10094;</button>
                            <button class="carousel-control-next" onclick="nextSlide(event, ${prodotto.idProdotto})">&#10095;</button>
                            <div class="carousel-indicators">${indicators}</div>
                        </div>
                        <div class="description">
                            <p>${prodotto.nome}</p>
                            <p class="weight">${prodotto.peso}g</p>
                            <div class="buttons">
                                <p>${parseFloat(prodotto.prezzo)}€</p>
                                <div class="allergen-container">
                                    <i class="fa-solid fa-info" onclick="toggleAllergenInfo()"></i>
                                    <div class="allergen-info" id="allergen-info">
                                        <p>Allergeni:</p>
                                        <ul>
                                            ${prodotto.allergeni ? prodotto.allergeni.map(allergene => `<li>${allergene}</li>`).join('') : '<li>Non specificato</li>'}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
            });

            document.getElementById('content-product').innerHTML = output;
        },
        error: function (xhr, status, error) {
            console.log("Errore nella richiesta AJAX", xhr.responseText);
            Swal.fire('Errore', 'Si è verificato un errore durante il recupero del menu.', 'error');
        }
    });
}



function reindirizza(url, num1, num2){
    window.location.replace(url+".php?" + num1 + "&"+ num2);
}
