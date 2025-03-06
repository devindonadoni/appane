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
    <link rel="stylesheet" href="style/style-index.css">
    <link rel="stylesheet" href="style/style-dropdown.css">


    <style>
        body {
            overflow-y: hidden;
        }
    </style>
</head>

<body>
    <div class="header">
        <a href="index.php"><img src="img/logo.png" alt=""></a>
        <div class="link">
            <a href="menu.php">
                <p>Menu</p>
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
            <a href="carrello.php" class="cart-wrapper">
                <i class="fa-solid fa-basket-shopping"></i>
                <?php
                if ($idCliente) {
                    if ($result) {
                        echo '<span class="cart-count">';
                        echo $countCart;
                        echo '</span> <!-- Numero hardcoded -->';
                    }
                }
                ?>
            </a>
            <?php include 'profile-menu.php' ?>
        </div>
        <!-- Menu a panino -->
        <div class="hamburger-menu">
            <i class="fa-solid fa-bars" onclick="toggleMobileMenu()"></i>
        </div>
    </div>
    <div class="main-container">

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


        <div class="video-player">
            <video src="img/4038465-uhd_4096_2160_25fps.mp4" autoplay muted loop></video>
            <div class="video-overlay">
                <h1 class="video-title">Esplora subito il menu della settimana</h1>
                <a href="menu.php"><button class="cta-button">Scopri di più</button></a>
            </div>
            <div class="video-bottom-text" onclick="redirect('chi-siamo')">
                <p>Scopri chi siamo</p>
                <i class="fa-solid fa-caret-down"></i>
            </div>
        </div>
    </div>

    <!-- Aggiungi subito prima della chiusura del tag body -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

</body>
<script src="js/universal-script.js"></script>
<script src="js/profile-menu.js"></script>

</html>