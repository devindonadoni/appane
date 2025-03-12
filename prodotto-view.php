<?php
include 'api/config/database.php';

include 'login.php';

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appane</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c5c930d58.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">

    <!-- Aggiungi nel tag head -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link rel="stylesheet" href="style/style-header.css">
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-prodotto.css">
    <link rel="stylesheet" href="style/style-dropdown.css">
</head>

<body>
    <div class="header">
        <a href="index.php"><img src="img/logo.png" alt=""></a>
        <div class="link">
            <a href="menu.php">
                <p id="active">Menu</p>
            </a>
            <a href="chi-siamo.php">
                <p>Chi siamo</p>
            </a>
            <a href="consegna.php">
                <p>Consegna</p>
            </a>
            <a href="contatti.php">
                <p>Contatti</p>
            </a>
        </div>
        <div class="nav-link">
            <a href="carrello.php" class="cart-wrapper"><i class="fa-solid fa-basket-shopping"></i>
            <?php
                if ($idCliente) {
                    if ($result) {
                        echo '<span class="cart-count">';
                        echo $countCart;
                        echo '</span> <!-- Numero hardcoded -->';
                    }
                }
                ?>

            <?php include 'profile-menu.php' ?>

        </div>
        <!-- Menu a panino -->
        <div class="hamburger-menu">
            <i class="fa-solid fa-bars" onclick="toggleMobileMenu()"></i>
        </div>
    </div>
    <div class="main-container">
        <video autoplay muted loop id="myVideo">
            <source src="img/stock/247855_small.mp4" type="video/mp4">
        </video>

        <div class="video-overlay"></div>

        <div class="vendita-bar">
            <i class="fa-solid fa-store"></i>
            <p>MENU DELLA SETTIMANA ORA DISPONIBILE</p>
        </div>

        <!-- Menu mobile -->
        <div id="mobile-menu" class="mobile-menu hidden">
            <a href="menu.php">Menu</a>
            <a href="chi-siamo.php">Chi siamo</a>
            <a href="consegna.php">Consegna</a>
            <a href="contatti.php">Contatti</a>
            <div class="mobile-icons">
                <a href="profilo.php"><i class="fa-solid fa-user"></i></a>
                <a href="carrello.php"><i class="fa-solid fa-basket-shopping"></i></a>
            </div>
        </div>

        <div class="prodotto-content" id="prodotto-content">
        </div>


        <div class="button-content">
            <div class="quantita-content">
                <select name="Qty" id="quantita">
                    <option value="">Qty</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>

                </select>
                <i class="fa-solid fa-chevron-down arrow-icon"></i>
            </div>
            <div class="button">
                <h1>Aggiungi al carrello</h1>
            </div>
        </div>

    </div> <!-- div main-container-->


    <div class="footer">
        <div class="up-content">
            <div class="rigraziamenti">
                <img src="img/logo.png" alt="">
                <p>Grazie per aver scelto la nostra bakery! <br> Siamo felici di addolcire ogni tuo <br>momento
                    speciale. ❤️
                </p>
            </div>
            <div class="links-footer">
                <h1 class="link-title">Links</h1>
                <div class="links-p">
                    <p>Home</p>
                    <p>Consegna</p>
                    <p>Chi siamo</p>
                    <p>Contatti</p>
                </div>
            </div>
            <div class="office">
                <h1 class="link-title">Office</h1>
                <p>Via alviano 4</p>
                <p>Trieste, TS 34128</p>
                <p>signor@appane.it</p>
            </div>
            <div class="news-seller">
                <h1 class="link-title">Newseller</h1>
                <div class="email">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="text" placeholder="Inserisci la tua email">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div class="socials">
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-square-x-twitter"></i>
                    <i class="fa-brands fa-whatsapp"></i>
                    <i class="fa-brands fa-pinterest"></i>
                </div>
            </div>
        </div>

        <div class="center-label">
            <p>Appane 2025 </p>
            <i class="fa-regular fa-copyright"></i>
            <p>-Tutti i diritti riservati</p>
        </div>
    </div>





    <!-- Aggiungi subito prima della chiusura del tag body -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

</body>
<script src="js/load-prodotto.js"></script>
<script src="js/universal-script.js"></script>
<script src="js/profile-menu.js"></script>
<script src="js/booking.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectBox = document.getElementById("quantita");
        const container = document.querySelector(".quantita-content");

        // Quando la select viene cliccata (o aperta)
        selectBox.addEventListener("click", function () {
            container.classList.toggle("open"); // Aggiunge/rimuove la classe per ruotare la freccia
        });

        // Quando l'utente seleziona un'opzione
        selectBox.addEventListener("change", function () {
            container.classList.add("open"); // Mantiene la freccia ruotata
        });

        // Quando la select perde il focus (clic fuori)
        selectBox.addEventListener("blur", function () {
            container.classList.remove("open"); // Rimuove la rotazione solo se serve
        });
    });
</script>


<script>
    $(document).ready(function () {
        // Ottenere i parametri GET dalla URL
        const urlParams = new URLSearchParams(window.location.search);
        const idProdotto = urlParams.get('idProdotto'); // Ottiene il valore di 'idProdotto' dalla URL
        const idMenu = urlParams.get('idMenu');

        if (idProdotto) {
            console.log("ID prodotto trovato:", idProdotto);
            getProdotto(idProdotto);
        } else {
            console.error("Nessun idProdotto trovato nella URL");
        }
    });

</script>


<script>
    const idUtente = "<?php echo isset($_SESSION['idCliente']) ? $_SESSION['idCliente'] : ''; ?>";  // Recupera l'ID utente dalla sessione PHP
    const checkoutBtn = document.querySelector('.button');
    checkoutBtn.addEventListener('click', getData);

    let idProdotto = "";  // Definisci idProdotto come variabile globale
    let idMenu = "";

    // Funzione per ottenere i dati dalla URL
    function getData() {
        const quantita = document.getElementById('quantita').value;
        
        // Recupera i parametri dalla URL
        const urlParams = new URLSearchParams(window.location.search);
        idProdotto = urlParams.get('idProdotto'); // Ottiene il valore di 'idProdotto' dalla URL
        idMenu = urlParams.get('idMenu');

        const dataPrenotazione = {
            idProdotto: idProdotto, // Usa la variabile globale idProdotto
            idMenu: idMenu,
            quantita: quantita
        };

        // Verifica se l'utente è loggato e se è stata selezionata una quantità valida
        if (idUtente != "") {
            if (quantita != 0) {
                sendBooking(dataPrenotazione);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: "Quantita' errata",
                    text: 'Inserire una quantità valida',
                    confirmButtonText: 'Ok'
                });
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: "Utente non loggato",
                text: 'Effettua il login per procedere.',
                confirmButtonText: 'Ok'
            });
        }
    }

    // Funzione per inviare la richiesta di verifica
    async function sendBooking(dataPrenotazione) {
        try {
            const response = await fetch('api/prodotti/verifica-disponibilita.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(dataPrenotazione), // Passa direttamente l'oggetto dataPrenotazione
            });

            const result = await response.json();
            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Verifica Quantità',
                    text: 'I prodotti sono disponibili.',
                    confirmButtonText: 'Ok'
                });
                


                try {
                    const response = await fetch('api/prodotti/prenota.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(dataPrenotazione), // Passa direttamente l'oggetto dataPrenotazione
                    });

                    const result = await response.json();
                    
                    if (result.success) {
                        Swal.fire({
                                icon: 'success',
                                title: 'Prenotazione completata!',
                                text: 'Conferma il tuo ordine nel carrello.',
                                confirmButtonText: 'Vai al carrello',
                            }).then(() => {
                                if(result.isConfirmed){
                                    window.location.href = 'cart.php';
                                }else{
                                    window.location.href = 'index.php'
                                }
                            });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Errore nella richiesta',
                            text: result.message, // Usa il messaggio restituito dal server
                            confirmButtonText: 'Ok'
                        });
                    }
                } catch (error) {
                    console.error("Errore durante la richiesta:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Errore di connessione',
                        text: 'Errore durante la connessione all\'API.',
                        confirmButtonText: 'Ok'
                    });
                }










            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Errore nella richiesta',
                    text: result.message, // Usa il messaggio restituito dal server
                    confirmButtonText: 'Ok'
                });
            }
        } catch (error) {
            console.error("Errore durante la richiesta:", error);
            Swal.fire({
                icon: 'error',
                title: 'Errore di connessione',
                text: 'Errore durante la connessione all\'API.',
                confirmButtonText: 'Ok'
            });
        }
    }

</script>

</html>