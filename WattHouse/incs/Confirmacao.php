<?php
require_once "../src/ProdutoDAO.php";
require_once "../src/UsuarioDAO.php";
require_once "../src/ClienteDAO.php";
require_once "../src/CartaoDAO.php";
require_once "../src/CompraDAO.php";

$produtoDAO = new ProdutoDAO();
$usuarioDAO = new UsuarioDAO();
$clienteDAO = new ClienteDAO();
$cartaoDAO = new CartaoDAO();
$compraDAO = new CompraDAO();

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

if(isset($_REQUEST['switch']) && $_REQUEST['switch']==1){
    if (isset($_GET['acao']) && $_GET['acao']=='cadastro') {
        if ($_POST['senha']!=$_POST['senha2']) {
            $ht = "location:../".$server.".php?msg=Senha e/ou Email Incorretos";

            header($ht);
        }elseif ($clienteDAO->ConsultaEmail($_POST['email'])){
            $ht = "location:../".$server.".php?msg=Senha e/ou Email Incorretos";

            header($ht);
        }elseif ($_POST['senha']==$_POST['senha2']){
            $clienteDAO->cadastrar($_POST);
            $ht = "location:../".$server.".php?msg=Cliente Cadastrado";

            header($ht);
        }
    }elseif (isset($_GET['acao']) && $_GET['acao']=='editar') {
        if ($_POST['senha']!=$_POST['senha2']) {
            $ht = "location:../".$server.".php?msg=Senha e/ou Email Incorretos";

            header($ht);
        }elseif ($clienteDAO->ConsultaEmail($_POST['email'])){
            $ht = "location:../".$server.".php?msg=Senha e/ou Email Incorretos";

            header($ht);
        }elseif ($_POST['senha']==$_POST['senha2']){
            $clienteDAO->alterar($_POST);
            $ht = "location:../".$server.".php?msg=Cliente Cadastrado";

            header($ht);
        }
    }elseif (isset($_GET['acao']) && $_GET['acao']=='remover') {
        $clienteDAO->remover($_GET['p']); 
        $ht = "location:../".$server.".php?msg=Cliente Removido";

        header($ht);
    }
}elseif(isset($_REQUEST['switch']) && $_REQUEST['switch']==2){
    if (isset($_GET['acao']) && $_GET['acao']=='cadastro') {
        if ($_POST['senha']!=$_POST['senha2']) {
            $ht = "location:../".$server.".php?msg=Senha e/ou Login Incorretos";

            header($ht);
        }elseif ($usuarioDAO->ConsultaLogin($_POST['login'])){
            $ht = "location:../".$server.".php?msg=Senha e/ou Login Incorretos";

            header($ht);
        }elseif ($_POST['senha']==$_POST['senha2']){
            $usuarioDAO->cadastrar($_POST);
            $ht = "location:../".$server.".php?msg=Usuario Cadastrado";

            header($ht);
        }
    }elseif (isset($_GET['acao']) && $_GET['acao']=='editar') {
        if ($_POST['senha']!=$_POST['senha2']) {
            $ht = "location:../".$server.".php?msg=Senha e/ou Login Incorretos";

            header($ht);
        }elseif ($usuarioDAO->ConsultaLogin($_POST['login'])){
            $ht = "location:../".$server.".php?msg=Senha e/ou Login Incorretos";

            header($ht);
        }elseif ($_POST['senha']==$_POST['senha2']){
            $usuarioDAO->alterar($_POST);
            $ht = "location:../".$server.".php?msg=Usuario Cadastrado";

            header($ht);
        }
    }elseif (isset($_GET['acao']) && $_GET['acao']=='remover') {
        $usuarioDAO->remover($_GET['p']); 
        $ht = "location:../".$server.".php?msg=Usuario Removido";

        header($ht);
    }
}elseif(isset($_REQUEST['switch']) && $_REQUEST['switch']==3){
    if (isset($_GET['acao']) && $_GET['acao']=='cadastro') {
        $produtoDAO->cadastrar($_POST); 
        $ht = "location:../".$server.".php?msg=Produto Cadastrado";

        header($ht);
    }elseif (isset($_GET['acao']) && $_GET['acao']=='editar') {
        $produtoDAO->alterar($_POST);
        $ht = "location:../".$server.".php?msg=Produto Alterado";

        header($ht);
    }elseif (isset($_GET['acao']) && $_GET['acao']=='remover') {
        $produtoDAO->remover($_GET['p']); 
        $ht = "location:../".$server.".php?msg=Produto Removido";

        header($ht);
    }
}elseif(isset($_REQUEST['switch']) && $_REQUEST['switch']==4){
    $compraDAO->registrarCompra($_SESSION);
}

// esses ifs definem apagar e editar
    // if (isset($_GET['tipo']) && $_GET['tipo']=='produto' && isset($_GET['acao']) && $_GET['acao']=='remover'){
    //     $produtoDAO->remover($_GET['p']); 

    //     header("Location:../Lista.php?msg=Produto Removido");
    // }elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && isset($_GET['acao']) && $_GET['acao']=='remover'){
    //     $usuarioDAO->remover($_GET['p']);

    //     header("Location:../Lista.php?msg= Usuario Removido");
    // }elseif (isset($_GET['tipo']) && $_GET['tipo']=='cliente' && isset($_GET['acao']) && $_GET['acao']=='remover'){
    //     $clienteDAO->remover($_GET['p']); 

    //     header("Location:../Lista.php?msg=Cliente Removido");
    // }elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && $_GET['acao']=='editar' && $_POST['senha']!=$_POST['senha2']){

    //     header("Location:../Lista.php?msg=Senha e/ou Login Incorretos");
    // }elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && $_GET['acao']=='editar' && $_POST['senha']==$_POST['senha2']){
    //     $usuarioDAO->alterar($_POST); 

    //     header("Location:../Lista.php?msg=Usuario Alterado");
    // }elseif (isset($_GET['tipo']) && $_GET['tipo']=='cliente' && $_GET['acao']=='editar' && $_POST['senha']!=$_POST['senha2']){
    //     $p = $_POST['p'];
    //     header("Location:../Editar.php?acao=editar&p=13&tipo=cliente&msg=Senha e/ou Email Incorretos");
    // }elseif (isset($_GET['tipo']) && $_GET['tipo']=='cliente' && $_GET['acao']=='editar' && $_POST['senha']==$_POST['senha2']){
    //     $sql = $clienteDAO->alterar($_POST);
        
    //     header("Location:../Lista.php?msg=Cliente Alterado&m=".$sql."");
    // }elseif (isset($_GET['tipo']) && $_GET['tipo']=='produto' && $_GET['acao']=='editar'){
    //     $produtoDAO->alterar($_POST);

    //     header("Location:../Lista.php?msg=Produto Alterado");
    // }
    
    // esses ifs definem os os cadastros
    // if (isset($_POST['switch']) && $_POST['switch']==1 && ($_POST['senha']!=$_POST['senha2'])){

    //     header("location:../Cadastro.php?msg=Senha e/ou Email Incorretos");
    // }elseif (isset($_POST['switch']) && $_POST['switch']==1 && $clienteDAO->ConsultaEmail($_POST['email'])){

    //     header("Location:../Cadastro.php?tipo=usuario&msg=Cliente Existente");
    // }elseif(isset($_POST['switch']) && $_POST['switch']==1 && ($_POST['senha']==$_POST['senha2'])){
    //     $clienteDAO->cadastrar($_POST); 
        
    //     header("location:../Cadastro.php?msg=Cliente Cadastrado");
    // }
    // if (isset($_POST['switch']) && $_POST['switch']==2 && ($_POST['senha']!=$_POST['senha2'])) {
        
    //     header("location:../Cadastro.php?msg=Senha e/ou Login Incorretos");
    // }elseif (isset($_POST['switch']) && $_POST['switch']==1 && isset($_GET['tipo']) && $_GET['tipo']=='cliente' && $usuarioDAO->ConsultaLogin($_POST['login'])){

    //     header("Location:../Cadastro.php?tipo=usuario&msg=Usuario Existente");
    // }elseif(isset($_POST['switch']) && $_POST['switch']==2 && ($_POST['senha']==$_POST['senha2'])){
    //     $usuarioDAO->cadastrar($_POST);

    //     header("location:../Cadastro.php?msg=Usuario Cadastrado");
    // }
    // if(isset($_POST['switch']) && $_POST['switch']==3){
    //     $produtoDAO->cadastrar($_POST); 
        
    //     header("Location:../Cadastro.php?msg=Produto Cadastrado");
    // }

    
    //elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && $_GET['acao']=='cadastro' && !$usuarioDAO->ConsultaLogin($_POST['login']) && $_POST['senha']==$_POST['senha2']){
    //     $usuarioDAO->cadastrar($_POST); 
    //     header("Location:Cadastro.php?tipo=usuario&msg=Usuario Cadastrado");
    // }elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && $_GET['acao']=='cadastro' && !$usuarioDAO->ConsultaLogin($_POST['login']) && $_POST['senha']!=$_POST['senha2']){
    //     header("Location:Cadastro.php?tipo=usuario&msg=Senha e/ou Login Incorretos");
    // }elseif (isset($_GET['tipo']) && $_GET['tipo']=='produto' && $_GET['acao']=='cadastro'){
    //     $produtoDAO->cadastrar($_POST); 
    //     header("Location:Cadastro.php?tipo=produto&msg=Produto Cadastrado");
    // }
?>