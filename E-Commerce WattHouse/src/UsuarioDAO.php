<?php
    require_once "ConexaoBD.php";

    class UsuarioDAO{
        static function ConsultaTodos(){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();
            $sql = "select * from watthouse.usuarios;";
            $resultado = $ConexaoBD->query($sql);
            $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        }
        static function ConsultaID(){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();
            $sql = "select * from watthouse.usuarios where idusuarios='{$_GET['p']}';";
            $resultado = $ConexaoBD->query($sql);
            return $resultado->fetch(PDO::FETCH_ASSOC);
        }
        static function ConsultaLogin($login){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();

            $sql = "select * from watthouse.usuarios where login='{$login}';";
            
            $resultado = $ConexaoBD->query($sql);
            $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        }
        static function Validar($dados){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();
            $senha = md5($dados['senha']);
            $sql = "select * from watthouse.usuarios where login='{$dados['login']}' and senha='{$senha}';";
            $resultado = $ConexaoBD->query($sql);
            $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        }
        function cadastrar($dados){
            //conectar
            $conexao = ConexaoBD::conectar();
            $senha = md5($dados['senha']);
            $sql = "insert into watthouse.usuarios (nome, login, senha) values ('{$dados['nome']}','{$dados['login']}', '$senha');";
            
            $conexao->exec($sql);
        }
        function remover($p){
            //conectar
            $conexao = ConexaoBD::conectar();
            $sql = "delete from usuarios where idusuarios='$p'";
            $conexao->exec($sql);
        }
        function alterar($dados){
            //conectar
            $conexao = ConexaoBD::conectar();
            $id = $_POST['p'];
            $senha = md5($dados['senha']);
            $sql = "update watthouse.usuarios set nome='{$dados['nome']}', login='{$dados['login']}', senha='{$senha}' where idusuarios='{$id}'";
            $conexao->exec($sql);
        }
        function ConsultaChave($chave){
            //conectar
            $conexao = ConexaoBD::conectar();
            
            $sql = "select * from watthouse.usuarios where (nome like '%$chave%' || login like '%$chave%')";

            $resultado = $conexao->query($sql);
            $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

            return $usuarios;
        }
    }

?>