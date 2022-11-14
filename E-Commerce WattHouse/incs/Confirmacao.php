<?php
require_once "../src/ProdutoDAO.php";
require_once "../src/UsuarioDAO.php";
require_once "../src/ClienteDAO.php";
require_once "../src/CartaoDAO.php";

$produtoDAO = new ProdutoDAO();
$usuarioDAO = new UsuarioDAO();
$clienteDAO = new ClienteDAO();
$cartaoDAO = new CartaoDAO();


// esses ifs definem apagar e editar
    if (isset($_GET['tipo']) && $_GET['tipo']=='produto' && isset($_GET['acao']) && $_GET['acao']=='remover'){
        $produtoDAO->remover($_GET['p']); 

        header("Location:../Lista.php?msg=Produto Removido");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && isset($_GET['acao']) && $_GET['acao']=='remover'){
        $usuarioDAO->remover($_GET['p']);

        header("Location:../Lista.php?msg= Usuario Removido");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='cliente' && isset($_GET['acao']) && $_GET['acao']=='remover'){
        $clienteDAO->remover($_GET['p']); 
        $cartaoDAO->remover($_GET['p']);

        header("Location:../Lista.php?msg=Cliente Removido");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && $_GET['acao']=='editar' && ($_POST['senha']!=$_POST['senha2'])){

        header("Location:../Lista.php?msg=Senha e/ou Login Incorretos");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && $_GET['acao']=='editar' && ($_POST['senha']==$_POST['senha2'])){
        $usuarioDAO->alterar($_POST); 

        header("Location:../Lista.php?msg=Usuario Alterado");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='cliente' && $_GET['acao']=='editar' && ($_POST['senha']!=$_POST['senha2'])){

        header("Location:../Lista.php?msg=Senha e/ou Email Incorretos");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='cliente' && $_GET['acao']=='editar' && ($_POST['senha']==$_POST['senha2'])){
        $clienteDAO->alterar($_POST);
        
        header("Location:../Lista.php?msg=Cliente Alterado");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='produto' && $_GET['acao']=='editar'){
        $produtoDAO->alterar($_POST);

        header("Location:../Lista.php?msg=Produto Alterado");
    }
    
    // esses ifs definem os os cadastros
    if (isset($_POST['switch']) && $_POST['switch']==1 && ($_POST['senha']!=$_POST['senha2'])){

        header("location:../Cadastro.php?msg=Senha e/ou Email Incorretos");
    }elseif (isset($_POST['switch']) && $_POST['switch']==1 && isset($_GET['tipo']) && $_GET['tipo']=='cliente' && $clienteDAO->ConsultaEmail($_POST['email'])){

        header("Location:../Cadastro.php?tipo=usuario&msg=Cliente Existente");
    }elseif(isset($_POST['switch']) && $_POST['switch']==1 && ($_POST['senha']==$_POST['senha2'])){
        $clienteDAO->cadastrar($_POST); 
        
        header("location:../Cadastro.php?msg=Cliente Cadastrado");
    }
    if (isset($_POST['switch']) && $_POST['switch']==2 && ($_POST['senha']!=$_POST['senha2'])) {
        
        header("location:../Cadastro.php?msg=Senha e/ou Login Incorretos");
    }elseif (isset($_POST['switch']) && $_POST['switch']==1 && isset($_GET['tipo']) && $_GET['tipo']=='cliente' && $usuarioDAO->ConsultaLogin($_POST['login'])){

        header("Location:../Cadastro.php?tipo=usuario&msg=Usuario Existente");
    }elseif(isset($_POST['switch']) && $_POST['switch']==2 && ($_POST['senha']==$_POST['senha2'])){
        $usuarioDAO->cadastrar($_POST);

        header("location:../Cadastro.php?msg=Usuario Cadastrado");
    }
    if(isset($_POST['switch']) && $_POST['switch']==3){
        $produtoDAO->cadastrar($_POST); 
        
        header("Location:../Cadastro.php?msg=Produto Cadastrado");
    }

    
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