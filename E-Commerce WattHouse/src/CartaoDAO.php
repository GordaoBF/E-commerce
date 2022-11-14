<?php
    require_once "ConexaoBD.php";
    class CartaoDAO{
        static function ConsultaUltimo(){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();
            $sql='SELECT idcartao FROM watthouse.cartao order by idcartao desc limit 1;';
            $resultado = $ConexaoBD->query($sql);
            return $resultado->fetch(PDO::FETCH_ASSOC); 
        }
        static function ConsultaID($id){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();
            $sql='SELECT idcartao FROM watthouse.cartao where idcartao="'.$id.'";';
            $resultado = $ConexaoBD->query($sql);
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        function remover($id){
            //conectar
            $conexao = ConexaoBD::conectar();
            $sql = "delete FROM watthouse.cartao as ca, watthouse.clientes as cl where ca.idcliente=cl.idcliente;";
            $conexao->exec($sql);
        }
    }
?>