<?php
    require_once "ConexaoBD.php";
    require_once "CartaoDAO.php";
    

    class ClienteDAO{
        function cadastrar($dados){
            $conexaoBD = ConexaoBD::conectar();
            $senha = md5($dados['senha']);
            
            // cadastrar o cartão
            $sql2 = "insert into watthouse.cartao (nomecartao, numeros, agencia, 3numeros, data) values ('{$dados['nomecartao']}','{$dados['numeros']}','{$dados['agencia']}','{$dados['3numeros']}','{$dados['data']}');";
            $conexaoBD->exec($sql2);

            // pegar o ultimo cartão cadastrado e atrelar ao cliente
            $cartaoDAO = new CartaoDAO();
            $id = $cartaoDAO->ConsultaUltimo();

            // aqui vamo faze a consulta do id do cartão pra definir ele
            $sql = "insert into watthouse.clientes (nome, email, senha, cpf, idcartao) values ('{$dados['nome']}','{$dados['email']}', '$senha','{$dados['cpf']}','{$id['idcartao']}');";
            $conexaoBD->exec($sql);
        }
        static function ConsultaEmail($email){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();

            $sql = "select * from watthouse.clientes where email='{$email}';";

            $resultado = $ConexaoBD->query($sql);
            $clientes = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $clientes;
        }
        static function ConsultaTodos(){
            $conexaoBD = ConexaoBD::conectar();
            $sql = "select * from watthouse.clientes;";

            $resultado = $conexaoBD->query($sql);
            $clientes = $resultado->fetchAll(PDO::FETCH_ASSOC);

            return $clientes;
        }
        function ConsultaChave($chave){
            //conectar
            $conexao = ConexaoBD::conectar();
            
            $sql = "select * from watthouse.clientes where (nome like '%$chave%' || email like '%$chave%')";

            $resultado = $conexao->query($sql);
            $clientes = $resultado->fetchAll(PDO::FETCH_ASSOC);

            return $clientes;
        }
        static function alterar($dados){
            //conectar
            $conexao = ConexaoBD::conectar();
            $id = $dados['p'];
            $senha = md5($dados['senha']);
            $sql = "update watthouse.clientes set email='{$dados['email']}', senha='{$senha}', nome='{$dados['nome']}' where idclientes='$id'";
            $conexao->exec($sql);
            return $sql;
        }
        static function ConsultaID($id){
            //conectar
            $conexao = ConexaoBD::conectar();
            
            $sql = "select * from watthouse.clientes as cl, watthouse.cartao as ca where cl.idcartao=ca.idcartao and cl.idclientes='".$id."';";

            $resultado = $conexao->query($sql);
            $cliente = $resultado->fetch(PDO::FETCH_ASSOC);

            return $cliente;
        }
        static function Validar($dados){
            //conectar
            $conexao = ConexaoBD::conectar();
            if(isset($dados['senha'])){
                $senha = md5($dados['senha']);
                $sql = "select * from watthouse.clientes where email='{$dados['email']}' and senha='{$senha}';";
            }else {$sql = "select * from watthouse.clientes where email='{$dados['email']}';";}
            

            $resultado = $conexao->query($sql);
            $cliente = $resultado->fetch(PDO::FETCH_ASSOC);

            return $cliente;
        }
        function remover($id){
            //conectar
            $conexao = ConexaoBD::conectar();
            $sql = "delete from watthouse.clientes where idclientes='{$id}';";
            $conexao->exec($sql);
        }
    }
?>