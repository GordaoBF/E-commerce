<?php 
    session_start();
    include "incs/ValidarSessao.php";
    $server = $_SERVER['REQUEST_URI'];
    // define o servidor que vai retornar
    if (isset($_POST['server'])) {
        if (preg_match('/ADM/',$_POST['server'])) {
            $server = 'ADM';
            echo $server;
        }elseif (preg_match('/Home/',$_POST['server'])) {
            $server = 'Home';
        }elseif (preg_match('/Items/',$_POST['server'])) {
            $server = 'Items';
        }elseif (preg_match('/Product/',$_POST['server'])) {
            $server = 'Product';
        }elseif (preg_match('/Cadastro/',$_POST['server'])) {
            $server = 'Cadastro';
        }elseif (preg_match('/Editar/',$_POST['server'])) {
            $server = 'Editar';
        }elseif (preg_match('/Lista/',$_POST['server'])) {
            $server = 'Lista';
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Watthouse Admin</title>

    <!-- Bootstrap CSS CDN -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/estilo_menu.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body id="adm">    

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="ADM.php">
                <h3>WattHouse - Admin</h3>
                </a>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="Cadastro.php">                  
                        Cadastro
                    </a>
                </li>
                <li class="active">
                    <a href="Lista.php">                  
                        Lista
                    </a>
                </li>
                <li id="link">
                    <a href="#" id='link'>
                        <i class="fas fa-paper-plane"></i>
                        Contato
                    </a>
                </li>
                <li id="link">
                    <a href="Home.php" id="link">
                        Ir para o Site
                    </a>
                </li>
                <li id="link">
                    <a href="incs/LogOut.php" id="link">
                        Sair
                    </a>
                </li>
            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content">