<?php
    require_once "ConexaoBD.php";

    class CompraDAO{
        public function registrarCompra($dados){
            $conexao = ConexaoBD::conectar();
            $data = date('Y-m-d H:i');
            $sql = "insert into watthouse.compras (idclientes, data) values ('{$dados['idclientes']}', '$data')";

            $conexao ->exec($sql);
            $idcompras = $conexao->lastInsertId();

            $carrinho = $dados['carrinho'];
            foreach ($carrinho as $item) {
                $preco = number_format($item['preco']);
                $sql = "insert into watthouse.itens_compra(idcompras, idprodutos, quantidade, preco) values ('$idcompras','{$item['idprodutos']}','{$item['quantidade']}','".$preco."')";

                $conexao->exec($sql);
            }
        }
    }