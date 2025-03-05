<?php
include $_SERVER['DOCUMENT_ROOT'] . '/appane/api/config/database.php';
session_start();

$showModal = "";
$utenteSessione = "";

if(isset($_SESSION['email'])){
    $utenteSessione = $_SESSION['email'];
}

if ($utenteSessione == '') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        $sql = "SELECT idCliente, email, passW FROM tcliente WHERE email = '$email' AND passW = '$password'";
        $result = mysqli_query($db_remoto, $sql);

        if ($row = mysqli_fetch_assoc($result)) {


            $idUtente = $row['idCliente'];
            $email = $row['email'];

            // Registra i dati nella sessione
            $_SESSION['email'] = $email;
            $_SESSION['idCliente'] = $idUtente;
        } else {
            $error = "Username o password errati.";
            $showModal = true; // Mostra il modal se ci sono errori
        }
    }

}
?>



<!-- Sfondo sfocato -->
<div id="overlay" <?php echo $showModal ? 'style="display: block;"' : ''; ?>></div>

<!-- Modal di Login -->
<div id="loginModal" class="modal" <?php echo $showModal ? 'style="display: block;"' : ''; ?>>
    <div class="modal-content">
        <div class="up-content-login">
            <img src="img/logo.png" alt="">
            <span id="closeModal">&times;</span>
        </div>
        <form id="loginForm" method="POST">
            <div class="content">
                <h1>Accedi</h1>
                <input type="text" name="email" placeholder="examples@appane.com" required>
                <input type="password" name="password" placeholder="password" required>
                <?php if (isset($error)): ?>
                    <p style="color: red; display: flex; justify-content: center;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <button>ACCEDI</button>
                <a href="">
                    <p>Non hai un account? <span>Registrati</span></p>
                </a>
            </div>
        </form>
    </div>
</div>