<?php

$utente = "";
if (isset($_SESSION['email'])) {
    $utente = $_SESSION['email'];
    $idCliente = $_SESSION['idCliente'];
}


if ($utente != "") {
    $nomeUtente = "";
    $emailUtente = "";
    $sqlNome = "SELECT * FROM tcliente WHERE idCliente = '$idCliente'";
    $resultNome = mysqli_query($db_remoto, $sqlNome);


    if (mysqli_num_rows($resultNome) > 0) {
        while ($row = mysqli_fetch_assoc($resultNome)) {
            $nomeUtente = $row['nome'] . " " . $row["cognome"];
            $emailUtente = $row['email'];
        }
    }

    echo '<li class="profile-icon">
                                <a class="profile-link">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="name-container">
                                        <h1>' . $nomeUtente . '</h1>
                                        <p>' . $emailUtente . '</p>
                                    </div>
                                    <div class="dropmenu-element" onclick="redirect(\'#\')">
                                        <i class="fa-solid fa-user"></i>
                                        <p>Profilo</p>
                                    </div>
                                    <div class="dropmenu-element" onclick="redirect(\'ordini\')">
                                        <i class="fa-solid fa-truck"></i>                                        
                                        <p>Ordini</p>
                                    </div>
                                    <div class="dropmenu-element" onclick="redirect(\'#\')">
                                        <i class="fa-solid fa-gear"></i>    
                                        <p>Impostazioni</p>
                                    </div>
                                    <div class="dropmenu-element" onclick="redirect(\'#\')">
                                        <i class="fa-solid fa-comments"></i>
                                        <p>Help</p>
                                    </div>
                                    <div class="dropmenu-element-signout" onclick="logout()">
                                        <i class="fa-solid fa-sign-out"></i>
                                        <p>SIGN OUT</p>
                                    </div>
                                </div>
                            </li>';
} else {
    echo '<li><a class="profile-link"><i class="fa-solid fa-user"></i></a></li>';
}
?>