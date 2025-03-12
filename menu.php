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
    <link rel="stylesheet" href="style/style-menu.css">
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

        <div class="menu-content">
            <h1>Menu della settimana</h1>
            <div class="search-bar">
                <div class="ricerca">
                    <input type="text" placeholder="Cerca">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="right-side">
                    <!-- <div class="prezzo">
                        <select name="prezzo-select">
                            <option value="">Prezzo</option>
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                          </select>
                    </div> -->
                    <div class="allergeni">
                        <select name="allergeni-select" >
                            <option value="">Allergeni</option>
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                          </select>                
                    </div>
                    <i class="fa-solid fa-sort"></i>
                </div>
            </div>

            <div class="content-product" id="content-product">
                
            </div>
        </div>
        
    </div> <!-- div main-container-->


    <div class="footer">
        <div class="up-content">
            <div class="rigraziamenti">
                <img src="img/logo.png" alt="">
                <p>Grazie per aver scelto la nostra bakery! <br> Siamo felici di addolcire ogni tuo <br>momento speciale. ❤️
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
<script src="js/universal-script.js"></script>
<script src="js/profile-menu.js"></script>
<script src="js/load-menu.js"></script>

<script>
    $(document).ready(function() {
        getMenu();
        
});
</script>

</html>