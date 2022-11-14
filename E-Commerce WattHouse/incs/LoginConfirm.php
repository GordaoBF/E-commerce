<?php
session_start();
require_once "../src/UsuarioDAO.php";
require_once "../src/ClienteDAO.php";

$usuarioDAO = new UsuarioDAO();
$clienteDAO = new ClienteDAO();

if(isset($_POST['login']) && !isset($_POST['cliente'])){
    if ($usuarioDAO->Validar($_POST)) {
        $_SESSION['login'] = $_POST['login'];
        header('Location:../ADM.php');
    }else{
        header('Location:../Login.php?msg=Senha e/ou Login Incorretos');
    }
}elseif(!isset($_POST['login']) && isset($_POST['cliente'])){
    if ($clienteDAO->Validar($_POST)) {
        $_SESSION['cliente'] = $_POST['cliente'];
    }else {
        header('Location:../Home.php?msg=Email e/ou Senha inválidos');
    }
}elseif(!isset($_POST['login']) && !isset($_POST['cliente'])){}

// if (isset($_POST['login']) && !isset($_POST['cliente']) && $usuarioDAO->Validar($_POST)) {
//     $_SESSION['login'] = $_POST['login'];
//     header('Location:../A
//     DM.php');
// }elseif(!isset($_POST['login']) && isset($_POST['cliente']) && $clienteDAO->Validar($_POST)){
//     $_SESSION['cliente'] = $_POST['login'];
// }elseif (isset($_POST['login']) && !isset($_POST['cliente']) && $usuarioDAO->Validar($_POST)) {
//     header('Location:../Login.php?msg=Senha e/ou Login Incorretos');
// }
?>
