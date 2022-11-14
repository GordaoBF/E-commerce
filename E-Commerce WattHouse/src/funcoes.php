<?php

function pegarImagem(Array $files):string{
    $nome_img = $files['imagem']['name'];
    $tipo_img = $files['imagem']['type'];
    $tam_img = $files['imagem']['size'];
    $imagem = $files['imagem']['tmp_name'];

    $fp = fopen($imagem, "rb");
    $imagem = fread($fp, $tam_img);
    $imagem = addslashes($imagem);
    fclose($fp);

    return $imagem;
}
function verify(){
    $produtoDAO = new ProdutoDAO();
    $usuarioDAO = new UsuarioDAO();
    if(isset($_GET['tipo']) && !isset($_GET['p']) && !isset($_GET['acao'])){
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='produto' && isset($_GET['p']) && $_GET['acao']=='remover'){
        $produtoDAO->remover($_GET['p']); 
        header("Location:Lista.php?tipo=produto&msg=Produto Removido");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && isset($_GET['p']) && $_GET['acao']=='remover'){
        $usuarioDAO->remover($_GET['p']); 
        header("Location:Lista.php?tipo=usuario&msg=Usuario Removido");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && $_GET['acao']=='editar' && $_POST['senha']==$_POST['senha2']){
        $usuarioDAO->alterar($_POST); 
        header("Location:Lista.php?tipo=usuario&msg=Usuario Alterado");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && $_GET['acao']=='editar' && $_POST['senha']!=$_POST['senha2']){
        header("Location:Lista.php?tipo=usuario&msg=Senha e/ou Login Incorretos");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='produto' && $_GET['acao']=='editar'){
        $produtoDAO->alterar($_POST);
        header("Location:Lista.php?tipo=produto&msg=Produto Alterado");
    }elseif (isset($_GET['acao']) && $_GET['acao']=='cadastro' && isset($_GET['tipo']) && $_GET['tipo']=='usuario' && $usuarioDAO->ConsultaLogin($_POST['login'])){
        header("Location:Cadastro.php?tipo=usuario&msg=Usuario Existente");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && $_GET['acao']=='cadastro' && !$usuarioDAO->ConsultaLogin($_POST['login']) && $_POST['senha']==$_POST['senha2']){
        $usuarioDAO->cadastrar($_POST); 
        header("Location:Cadastro.php?tipo=usuario&msg=Usuario Cadastrado");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='usuario' && $_GET['acao']=='cadastro' && !$usuarioDAO->ConsultaLogin($_POST['login']) && $_POST['senha']!=$_POST['senha2']){
        header("Location:Cadastro.php?tipo=usuario&msg=Senha e/ou Login Incorretos");
    }elseif (isset($_GET['tipo']) && $_GET['tipo']=='produto' && $_GET['acao']=='cadastro'){
        $produtoDAO->cadastrar($_POST); 
        header("Location:Cadastro.php?tipo=produto&msg=Produto Cadastrado");
    }
}