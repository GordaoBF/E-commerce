<?php
require_once "src/UsuarioDAO.php";

$usuarioDAO = new UsuarioDAO();
if (isset($title) && (preg_match('/Items/', $title) || preg_match('/Home/', $title) || preg_match('/Product/', $title)) && !isset($_GET['v'])) {
    if (!$_SESSION['cliente']) {
        header("Location:Home.php?v=");
    }
}else{
    if (!isset($_SESSION['login'])) {
        header("Location:Login.php?msg=Faça o login, Caralho");
    }
}
?>