<?php 
    include "incs/topo.php"; 
    include "incs/produto.php" 
?>
    <!-- modal imagem -->
    <div>
        <div class="modal fade" tabindex="-1" id="imagem">
            <div class="modal-dialog image modal-dialog-centered">
                <div class="modal-content">
                    <img src='data:image/png;base64,<?=base64_encode($it['imagem']) ?>' width='500px' title='' alt=''>
                </div>
            </div>
        </div>
    </div>
<?php 
include "incs/rodape.php"; 
?>