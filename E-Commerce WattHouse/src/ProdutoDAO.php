<?php
    require_once "ConexaoBD.php";
    require_once "funcoes.php";

    class ProdutoDAO{
        static function ConsultaID($id){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();
            // if (isset($_GET['p'])) {
            //     $id = $_GET['p'];
            // }else {$id = $_POST['p'];}
            $sql='select * from watthouse.produtos where idprodutos="'.$id.'";';    
            $resultado = $ConexaoBD->query($sql);
            $produto = $resultado->fetch(PDO::FETCH_ASSOC);
            return $produto;
        }
        static function ConsultaTodos(){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();
            $sql = "select * from watthouse.produtos as p, watthouse.categorias as c where p.idcategorias=c.idcategorias;";
            $resultado = $ConexaoBD->query($sql);
            $produtos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $produtos;
        }
        static function ConsultaPromo(){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();
            $sql = "select * from watthouse.produtos where promocao='1';";
            $resultado = $ConexaoBD->query($sql);
            $produtos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $produtos;
        }
        static function ConsultaTipo($cat){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();
            $sql='select * from watthouse.produtos where idcategorias="'.$cat.'";';    
            $resultado = $ConexaoBD->query($sql);
            $produtos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $produtos;
        }
        static function ConsultaTipoPromo($i){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();
            $sql='select * from watthouse.produtos where idcategorias="'.$i.'" and promocao="1" limit 5;';    
            $resultado = $ConexaoBD->query($sql);
            $produtos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $produtos;
        }
        function cadastrar($dados){
            //conectar
            $conexao = ConexaoBD::conectar();
            if (isset($dados['promocao'])){
                $promocao = 1;
                $desconto = $dados['desconto'];
            }
            else {
                $promocao = 0;
                $desconto = 0;
            }
            $imagem = pegarImagem($_FILES);
            $preco = number_format($dados['preco'],2,'.','');
            //montar sql
            $sql = "insert into watthouse.produtos (nome, descricao, preco, quantidade, marca, idcategorias, promocao, desconto, imagem) values ('{$dados['nome']}','{$dados['descricao']}', '$preco', '{$dados['quantidade']}','{$dados['marca']}','{$dados['idcategorias']}','$promocao', '$desconto','$imagem')";
            //enviar dados
            $conexao->exec($sql);
        }
        function remover($p){
            //conectar
            $conexao = ConexaoBD::conectar();
            $sql = "delete from watthouse.produtos where idprodutos='$p'";
            $conexao->exec($sql);
        }
        function alterar($dados){
            //conectar
            $conexao = ConexaoBD::conectar();
            $id = $_REQUEST['p'];
            if (isset($dados['promocao'])){
                $promocao = 1;
                $desconto = $dados['desconto'];
            }else {
                $promocao = 0;
                $desconto = 0;
            }
            if ($_FILES['imagem']['size']>0){
                $imagem = pegarImagem($_FILES);
                $sql = "update watthouse.produtos  set nome='{$dados['nome']}', descricao='{$dados['descricao']}', preco='{$dados['preco']}', promocao='{$promocao}', quantidade='{$dados['quantidade']}', desconto='{$desconto}', marca='{$dados['marca']}', idcategorias='{$dados['idcategorias']}', imagem='{$imagem}' where idprodutos='".$id."'";
            }else {
                $sql = "update watthouse.produtos  set nome='{$dados['nome']}', descricao='{$dados['descricao']}', preco='{$dados['preco']}', promocao='{$promocao}', quantidade='{$dados['quantidade']}', desconto='{$desconto}', marca='{$dados['marca']}', idcategorias='{$dados['idcategorias']}' where idprodutos='".$id."'";
            }
            
            
            $conexao->exec($sql);
        }
        static function ConsultaChave($chave){
            //conectar
            $conexao = ConexaoBD::conectar();
            if (is_numeric($chave) || is_float($chave)) {
                $sql = "select * from watthouse.produtos as p, watthouse.categorias as e where p.idcategorias=e.idcategorias and (preco like '%".$chave."%' || desconto like '%".$chave."%')";
            }else{
                $sql = "select * from watthouse.produtos as p, watthouse.categorias as e where p.idcategorias=e.idcategorias and (nome like '%".$chave."%' || marca like '%".$chave."%')";
            }
            

            $resultado = $conexao->query($sql);
            $produtos = $resultado->fetchAll(PDO::FETCH_ASSOC);

            return $produtos;
        }
    }

?>