<?php 
class ConexaoBD {
    public static function conectar(){
        $conexaoBD = new PDO("mysql:host=localhost:3306;dbname=watthouse", "aluno", "pinguim");
        return $conexaoBD;
    }
}
