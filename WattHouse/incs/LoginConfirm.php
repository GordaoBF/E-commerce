<?php
session_start();
require_once "../src/UsuarioDAO.php";
require_once "../src/ClienteDAO.php";

$usuarioDAO = new UsuarioDAO();
$clienteDAO = new ClienteDAO();

if (isset($_REQUEST['server'])) {
    if (preg_match('/ADM/',$_REQUEST['server'])) {
        $server = 'ADM';
        echo $server;
    }elseif (preg_match('/Home/',$_REQUEST['server'])) {
        $server = 'Home';
    }elseif (preg_match('/Items/',$_REQUEST['server'])) {
        $server = 'Items';
    }elseif (preg_match('/Product/',$_REQUEST['server'])) {
        $server = 'Product';
    }elseif (preg_match('/Cadastro/',$_REQUEST['server'])) {
        $server = 'Cadastro';
    }elseif (preg_match('/Editar/',$_REQUEST['server'])) {
        $server = 'Editar';
    }elseif (preg_match('/Lista/',$_REQUEST['server'])) {
        $server = 'Lista';
    }
}

if(isset($_POST['login']) && !isset($_POST['email'])){
    if ($usuarioDAO->Validar($_POST)) {
        $_SESSION['login'] = $_POST['login'];
        $ht = "location:../".$server.".php";

        header($ht);
    }else{
        $ht = "location:../".$server.".php?msg=Senha e/ou Login Incorretos";

        header($ht);
    }
}elseif(!isset($_POST['login']) && isset($_POST['email'])){
    if ($cl = $clienteDAO->Validar($_POST)) {
        $_SESSION['cliente'] = $cl['idclientes'];
        $ht = "location:../".$server.".php";
        
        header($ht);
    }elseif ($_POST['senha']) {
        $ht = "location:../".$server.".php?msg=Email e/ou Senha invalidos";
        
        header($ht);
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
