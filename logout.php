<?php
include $_SERVER['DOCUMENT_ROOT'] . '/appane/api/config/database.php';
session_start();

session_destroy();

// Reindirizza alla pagina di login o homepage
header("Location: index.php");
exit;

?>