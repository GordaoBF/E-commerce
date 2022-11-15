<?php
    require_once "ConexaoBD.php";
    class CategoriaDAO{
        static function ConsultaCat(){
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();
            $sql='select * from watthouse.categorias;';
            $resultado = $ConexaoBD->query($sql);
            return $resultado->fetchAll(PDO::FETCH_ASSOC);;
        }
        static function ConsultaCatID(){
            if (isset($_GET['tipo'])) {
                $tipo = $_GET['tipo'];
            }
            // conecto com o banco de dados
            $ConexaoBD = ConexaoBD::conectar();
            $sql='select * from watthouse.categorias where idcategorias="'.$tipo.'";';
            $resultado = $ConexaoBD->query($sql);
            return $resultado->fetchAll(PDO::FETCH_ASSOC);;
        }
    }
?>