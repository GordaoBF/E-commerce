<?php
session_start();
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
if (isset($_SESSION['idclientes'])) {
    unset($_SESSION['idclientes']);
    $ht = "location:../".$server.".php";

    header($ht);
}elseif ($_SESSION['login']) {
    unset($_SESSION['login']);
    $ht = "location:../".$server.".php";

    header($ht);
}



?>