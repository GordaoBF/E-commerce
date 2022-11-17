<?php

if (isset($title) && (preg_match('/items/', $title) || preg_match('/Home/', $title) || preg_match('/Product/', $title)) || preg_match('/finalizar/', $title)) {
    if (!isset($_SESSION['idclientes'])) {
    }
}else{
    if (!isset($_SESSION['login'])) {
        header("Location:../Login.php?msg=Faça o login, Caralho");
    }
}
?>