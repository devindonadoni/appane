<?php
include $_SERVER['DOCUMENT_ROOT'] . '/appane/api/config/database.php';

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

    <link rel="stylesheet" href="style/style-header.css">
    <link rel="stylesheet" href="style/style-chisiamo.css">
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
                <p id="active">Chi siamo</p>
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




        <div class="content-chisiamo">
            <div class="description-chisiamo">
                <h1>Chi siamo</h1>
                <p>Noi di Appane siamo felici di presentarvi il nostro brand, nato per celebrare la passione per la
                    panificazione artigianale e la bontà autentica. Con dedizione e cura, prepariamo ogni giorno
                    prodotti da forno freschi, pensati per regalare momenti di piacere in ogni morso.
                    Dai pani fragranti appena sfornati ai dolci che scaldano il cuore, ogni creazione è frutto di
                    un’attenta selezione di ingredienti genuini e di alta qualità. Siamo qui per offrirvi un’esperienza
                    che unisce tradizione e innovazione, con sapori che sanno di casa e profumi che conquistano al primo
                    respiro.</p>
            </div>
            <img src="img/stock/chisiamo.png" alt="">
        </div>

        <div class="content-mission">
            <img src="img/stock/mission.png" alt="">
            <div class="mission-description">
                <h1>La nostra missione</h1>
                <p>La nostra missione in Appane è portare ogni giorno sulle vostre tavole la bontà autentica della
                    panificazione artigianale. Crediamo nella qualità senza compromessi e nella cura dei dettagli,
                    selezionando con amore ingredienti genuini e freschi per creare prodotti che regalino emozioni ad
                    ogni morso. Vogliamo essere il punto di riferimento per chi cerca sapori veri, capaci di risvegliare
                    ricordi e creare nuovi momenti di felicità.</p>
            </div>
        </div>

        <div class="content-storia">
            <div class="storia-description">
                <h1>La nostra storia</h1>
                <p>
                    Nel 2020, a Trieste, è nata Appane, una panetteria che ha subito conquistato il cuore dei cittadini
                    con la sua proposta innovativa e autentica. Fondata da Andrea e il signor Appane, due giovani
                    appassionati di
                    panificazione e tradizioni locali, Appane ha subito puntato su ingredienti freschi e di qualità,
                    come le farine triestine e i lieviti naturali. La missione era chiara: portare un pane genuino, che
                    rispetta le tradizioni ma con un tocco di modernità. </p>
            </div>
            <img src="img/stock/storia.png" alt="">
        </div>

        <div class="content-hover">
            <div class="single-hover">
                <i class="fa-solid fa-map"></i>
                <p>Consegna in un giorno a Trieste</p>
                <a href="consegna.php"><u>Esplora</u></a>
            </div>
            <div class="single-hover">
                <i class="fa-solid fa-ranking-star"></i>
                <p>Campioni di qualita’ in tutto il FVG</p>
                <a href=""><u>Esplora</u></a>
            </div>
            <div class="single-hover">
                <i class="fa-solid fa-shop-lock"></i>
                <p>Pagamento alla consegna</p>
                <a href="pagamento.php"><u>Esplora</u></a>
            </div>
        </div>


        <div class="content-produzione">
            <div class="produzione-description">
                <p class="categoria">PRODUZIONE</p>
                <p class="title">QUALITA' ARTIGIALE</p>
                <p class="testo">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel nisl condimentum,
                    pellentesque
                    augue elementum, aliquam neque. Praesent imperdiet tortor ipsum, at lobortis nulla interdum in.</p>
                <button class="button">SCOPRI</button>
            </div>
            <img src="img/stock/produzione.png" alt="">
        </div>

        <div class="content-ingredienti">
            <img src="img/stock/ingredienti.png" alt="">
            <div class="ingredienti-description">
                <p class="categoria">PRODUZIONE</p>
                <p class="title">INGREDIENTI RICERCATI</p>
                <p class="testo">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel nisl condimentum,
                    pellentesque
                    augue elementum, aliquam neque. Praesent imperdiet tortor ipsum, at lobortis nulla interdum in.</p>
                <button class="button">SCOPRI</button>
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
<script src="js/profile-menu.js"></script>
<script src="js/universal-script.js"></script>

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


</html>