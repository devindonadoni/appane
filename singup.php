<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link rel="stylesheet" href="style.css">

    <style>
        /* Imposta lo sfondo della pagina con il gradiente */
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #433321, #3F2E1A, #372812, #3D290B, #472D03);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Centra il contenuto del form */
.registration-form {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 400px;
}

/* Stile del titolo */
h2 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    color: #3D290B;
}

/* Stile per i campi di input */
input[type="text"],
input[type="email"],
input[type="password"],
input[type="tel"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
input[type="tel"]:focus {
    outline: none;
    border-color: #A36D16; /* Colore del bordo quando il campo è in focus */
}

/* Stile del bottone di invio */
button[type="submit"] {
    background-color: #A36D16;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #8A5412; /* Colore più scuro al passaggio del mouse */
}

/* Stile dei campi di input per migliorare la visibilità */
input::placeholder {
    color: #6c4b2f;
}

/* Messaggi di errore e successo */
script {
    font-weight: bold;
    color: red;
}

    </style>
</head>
<body>
    <div class="registration-form">
        <h2>Registrazione Cliente</h2>
        <form id="formRegistrazione" action="" method="POST">
            <h3>Dati Cliente</h3>
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="text" name="cognome" placeholder="Cognome" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Conferma Password" required>
            <input type="tel" name="numeroTelefono" placeholder="Numero di Telefono" required>

            <h3>Indirizzo</h3>
            <input type="text" name="cap" placeholder="CAP" required>
            <input type="text" name="via" placeholder="Via" required>
            <input type="text" name="numeroCivico" placeholder="Numero Civico" required>
            <input type="text" name="interno" placeholder="Interno (opzionale)">

            <button type="submit" name="registrati">Registrati</button>
        </form>
    </div>

    <?php
    // db_remotoessione al database
    include_once 'api/config/database.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrati'])) {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $numeroTelefono = $_POST['numeroTelefono'];
        $cap = $_POST['cap'];
        $via = $_POST['via'];
        $numeroCivico = $_POST['numeroCivico'];
        $interno = isset($_POST['interno']) ? $_POST['interno'] : '';

        // Verifica se le password corrispondono
        if ($password !== $confirm_password) {
            echo "<script>alert('Le password non corrispondono.');</script>";
            exit;
        }
        // $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $db_remoto->prepare("INSERT INTO tindirizzo (cap, via, numeroCivico, interno) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $cap, $via, $numeroCivico, $interno);
        $stmt->execute();
        $idIndirizzo = $stmt->insert_id;

        // Inserisci il cliente nella tabella tCliente
        $stmt = $db_remoto->prepare("INSERT INTO tcliente (nome, cognome, email, passW, numeroTelefono, idIndirizzo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $nome, $cognome, $email, $passwordHash, $numeroTelefono, $idIndirizzo);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Registrazione avvenuta con successo!');</script>";
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Errore nella registrazione. Riprova.');</script>";
        }

        $stmt->close();
        $db_remoto->close();
    }
    ?>

</body>
</html>
