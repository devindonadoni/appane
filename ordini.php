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
    <link rel="stylesheet" href="style/style-ordini.css">
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


  <video autoplay muted loop id="myVideo">
            <source src="img/stock/247855_small.mp4" type="video/mp4">
        </video>

        <div class="video-overlay"></div>

        <div class="vendita-bar">
            <i class="fa-solid fa-store"></i>
            <p>MENU DELLA SETTIMANA ORA DISPONIBILE</p>
        </div>


    <h1 class="label">Le tue prenotazioni</h1>
    <div class="container-label">
      <ul class="tabs">
        <li class="tab-item">
          <a href="#item1" class="active">Tutte</a>
        </li>
        <li class="tab-item">
          <a href="#item2">Pagate</a>
        </li>
        <li class="tab-item">
          <a href="#item3">Cancellate</a>
        </li>
        <li class="tab-item">
          <a href="#item4">In elaborazione</a>
        </li>
        <div class="search-item">
          <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>
      </ul>
    </div>





    <div class="grid-container">
      <div class="wrapper_tab-content">

        <div id="item1" class="tab-content content-visible">
          <!-- Filtri -->
          <div class="container-filter">
            <div class="single-filter">
              <p>Evento</p>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="single-filter">
              <p>Luogo</p>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="single-filter">
              <p>Data</p>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="single-filter">
              <p>Posto</p>
            </div>
            <div class="single-filter">
              <p>Totale</p>
            </div>
          </div>

          <!-- Eventi -->
          <div class="container-event">
          </div>
        </div>




        <!-- event 2-->
        <div id="item2" class="tab-content">
          <!-- Filtri -->
          <div class="container-filter">
            <div class="single-filter">
              <p>Evento</p>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="single-filter">
              <p>Luogo</p>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="single-filter">
              <p>Data</p>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="single-filter">
              <p>Posto</p>
            </div>
            <div class="single-filter">
              <p>Totale</p>
            </div>
          </div>

          <!-- Eventi -->
          <div class="container-event"></div>
        </div>


        <!-- event 3-->
        <div id="item3" class="tab-content">
          <!-- Filtri -->
          <div class="container-filter">
            <div class="single-filter">
              <p>Evento</p>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="single-filter">
              <p>Luogo</p>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="single-filter">
              <p>Data</p>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="single-filter">
              <p>Posto</p>
            </div>
            <div class="single-filter">
              <p>Totale</p>
            </div>
          </div>

          <!-- Eventi -->
          <div class="container-event"></div>
        </div>





        <!-- event 4-->
        <div id="item4" class="tab-content">
          <!-- Filtri -->
          <div class="container-filter">
            <div class="single-filter">
              <p>Evento</p>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="single-filter">
              <p>Luogo</p>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="single-filter">
              <p>Data</p>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="single-filter">
              <p>Posto</p>
            </div>
            <div class="single-filter">
              <p>Totale</p>
            </div>
          </div>

          <!-- Eventi -->
          <div class="container-event"></div>
        </div>
      </div>
    </div> <!--  grid-container -->
  </div>

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

</body>

<script src="script/profile-menu.js"></script>
<script src="script/universal-scripts.js"></script>

<script>
  function getTab(el) {
    const active = document.querySelector(".active");
    const visible = document.querySelector(".content-visible");
    const tabContent = document.getElementById(el.href.split("#")[1]);

    active.classList.toggle("active");
    visible.classList.toggle("content-visible");

    el.classList.add("active");
    tabContent.classList.add("content-visible");
  }

  document.addEventListener("click", (e) => {
    if (e.target.matches(".tab-item a")) {
      document.body.scrollTop = 0; // Per Safari
      document.documentElement.scrollTop = 0; // Per Chrome, Firefox, IE, Edge
      getTab(e.target);
    }
  });


  document.querySelectorAll(".single-filter").forEach(filter => {
    filter.addEventListener("click", function () {
      let icon = this.querySelector("i");
      if (icon) {
        icon.classList.toggle("rotated");
      }
    });
  });
</script>

</html>