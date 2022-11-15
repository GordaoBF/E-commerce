<?php
if (preg_match('/Home/', $title)) {
   echo 'Home - Watthouse';
}elseif (preg_match('/Items/', $title) && (!isset($_GET['tipo']) && isset($_GET['chave']))) {
    echo $_GET['chave']; 
}elseif (preg_match('/items/', $title) && (isset($_GET['tipo']) && !isset($_GET['chave']))) {
    $cat = CategoriaDAO::ConsultaCat($_GET['tipo']);
    foreach($cat as $ca){
        if ($ca['idcategorias']==$_GET['tipo']) {
            echo $ca['categorias'].' - Watthouse';
        }
    }
}elseif (preg_match('/Product/', $title)) {
    $it = ProdutoDao::ConsultaID($_GET['p']);
            echo $it['nome'];
}
?>