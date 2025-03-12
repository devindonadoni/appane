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
    <link rel="stylesheet" href="style/style-cart.css">
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-dropdown.css">
</head>

<body>
    <div class="header">
        <a href="index.php"><img src="img/logo.png" alt=""></a>
        <div class="link">
            <a href="menu.php">
                <p>Menu</p>
            </a>
            <a href="chi-siamo.php">
                <p id="">Chi siamo</p>
            </a>
            <a href="consegna.php">
                <p>Consegna</p>
            </a>
            <a href="contatti.php">
                <p>Contatti</p>
            </a>
        </div>
        <div class="nav-link">
            <a href="" class="cart-wrapper"><i class="fa-solid fa-basket-shopping"></i>
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

        <h1 class="categoria-label">Carrello</h1>
        <div class="label-container">
            <p class="evento">Evento</p>
            <p>Timer</p>
            <p>Peso</p>
            <p>Totale</p>
        </div>

        <!-- Contenitore del carrello -->
        <div id="carrello-container">
            <?php
            if ($utente == "") {
                echo '
                <div class="no-items-container">
                    <p>Non sei loggato. Accedi per visualizzare il tuo carrello!</p>
                    <h1 onclick="redirect()">EFFETTUA IL LOGIN</h1>
                </div>';
            }
            ?>
        </div>

        <?php if ($utente != ""): ?>
            <div class="checkout-container" id="checkout-container">
                <div class="totale">
                    <h1>Totale:</h1>
                    <p id="totale">€0.00</p>
                </div>
                <div class="checkout-button-container" onclick="confermaIndirizzo()">
                    <input type="submit" name="checkout-button" id="checkout-button" value="CHECKOUT">
                </div>
            </div>
        <?php endif; ?>


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
<script src="js/profile-menu.js"></script>
<script src="js/universal-script.js"></script>
<script src="js/load-cart.js"></script>
<script src="js/remove-cart.js"></script>

<script>
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate'); // Aggiungi una classe che avvia l'animazione
                observer.unobserve(entry.target); // Non osservare più l'elemento dopo l'animazione
            }
        });
    }, { threshold: 0.35 }); // Trigger l'animazione quando il 50% dell'elemento è visibile

    // Aggiungi l'osservatore agli elementi
    document.querySelectorAll('.content-mission, .content-storia, .content-chisiamo, .content-produzione, .content-ingredienti').forEach((element) => {
        observer.observe(element);
    });

</script>


<script>
    $(document).ready(function () {
    console.log("Document ready!");
    caricaCarrello();
});
</script>


<script>
   function confermaIndirizzo() {
    // Recupera l'ID cliente dalla sessione
    var idCliente = <?php echo isset($_SESSION['idCliente']) ? json_encode($_SESSION['idCliente']) : 'null'; ?>;
    console.log(idCliente);
    if (!idCliente) {
        alert("Errore: ID cliente non disponibile");
        return;
    }

    // Prima chiamata AJAX per ottenere l'indirizzo di default
    fetch('api/prodotti/getIndirizzo.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ idCliente })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert("Errore nel recupero dell'indirizzo");
            return;
        }

        let indirizzoDefault = data.via;
        let numeroCivicoDefault = data.numeroCivico;
        let internoDefault = data.interno;
        let idIndirizzo = data.idIndirizzo;

        // Mostra tre prompt separati per via, numeroCivico e interno
        let via = prompt("Inserisci la via:", indirizzoDefault);
        if (!via) return;

        let numeroCivico = prompt("Inserisci il numero civico:", numeroCivicoDefault);
        if (!numeroCivico) return;

        let interno = prompt("Inserisci l'interno:", internoDefault || "");
        if (interno === null) return; // L'utente ha annullato l'input


        // Seconda chiamata AJAX per verificare o aggiungere l'indirizzo
        fetch('api/prodotti/VerificaIndirizzo.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({via, numeroCivico, interno })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert("Errore nella verifica dell'indirizzo");
                return;
            }

            let idIndirizzoCorretto = data.idIndirizzo;

            // Terza chiamata AJAX per confermare il checkout
            fetch('api/prodotti/checkout.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ idCliente, idIndirizzo: idIndirizzoCorretto })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                                title: "Ordine Confermato!",
                                text: "Il tuo ordine e' stato confermato.",
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => {
                                    window.location.href = 'carrello.php';
                            });
                } else {
                    alert("Errore nel completamento dell'ordine");
                }
            })
            .catch(error => console.error("Errore durante il checkout", error));
        })
        .catch(error => console.error("Errore durante la verifica dell'indirizzo", error));
    })
    .catch(error => console.error("Errore nel recupero dell'indirizzo", error));
}

</script>


</html>