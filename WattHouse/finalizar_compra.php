<?php 
include "incs/topo.php";

    $compraDAO = new CompraDAO();
    $compraDAO->registrarCompra($_SESSION); 
?>
    <div class="container w-75 my-5">
        <h4 class="text-center">Sua compra foi realizada com sucesso!</h4>
        <h4 class="text-center">Volte sempre!</h4>
        <h4 class="text-center">^_^</h4>
    </div>
<?php
    include "incs/rodape.php";
?>