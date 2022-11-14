<?php
$conexaoBD = ConexaoBD::conectar();
if (!isset($_GET['p'])) {
    echo "<p class='text-center fs-1 p-5 m-5'>Este produto não foi encontrado <br>¯\_(ツ)_/¯</p>";
}else if (isset($_GET['p'])) {
    $prod = $_GET['p'];
    $sql = "select * from watthouse.produtos where idprodutos=" . $prod. ";";
    $resultado = $conexaoBD->query($sql);
    $produtos = $resultado->fetchAll(PDO::FETCH_ASSOC);
}
if (isset($produtos) && empty($produtos)): ?>
   <p class='text-center fs-1 p-5 m-5'>Este produto não foi encontrado <br>¯\_(ツ)_/¯</p>
<?php elseif (isset($produtos) && !empty($produtos)):
    foreach ($produtos as $it):
        if ($it['promocao'] == 1): 
            $res = ($it['preco'] - ($it['preco'] * ($it['desconto'] / 100)));
            $rese = number_format($res, 2); ?>
            <!-- card <?=$it['nome']?> <?=$it['marca']?> -->
            <form action="<?=$server?>" method="post">
                <div class="container my-5 d-flex justify-content-center">
                    <div class='border p-5' id="div-image">
                        <a href='#imagem' data-bs-toggle='modal'><img class="" src='data:image/png;base64,<?=base64_encode($it['imagem']) ?>' width='500px' title='' alt='<?=$it['nome']?>-<?=$it['marca']?>'></a>
                    </div>
                    <div class="border px-5">
                            <input type="hidden" name="operacao" value="inserir">
                            <input type="hidden" name="p" value="<?=$it['idprodutos']?>">

                            <h2 class='py-3'><?=$it['nome']?> <?=$it['marca']?></h2>
                            <!-- descrição -->  
                            <a class="text-decoration-none text-dark dropdown-toggle" data-bs-toggle="collapse" href="#collapseDescricao" role="" aria-expanded="false" id="descricaoProduto">Descrição</a>
                            <div class="collapse border m-0 p-3" id="collapseDescricao">
                                <?=$it['descricao']?><br>Quantidade: <?=$it['quantidade']?>
                            </div>
                            <h5 class='fw-bold fs-6 text-secondary '><s><strong>R$ <?=$it['preco']?></strong></s></h5>
                            <h5 class='fw-bold fs-4'><strong>R$ <?=$rese?></strong><span class='border p-2 m-2 text-light bg-warning rounded-pill'><?=$it['desconto']?>%</span></h5>
                            <div class='col-12 pt-3'>
                                <button type="submit" class='w-100 btn btn-primary'>Adquirir</button>
                            </div>
                        </div>
                </div>
                
                <!-- modal imagem <?=$it['nome']?> <?=$it['marca']?> -->
                <div>
                    <div class='modal fade' tabindex='-1' id='imagem'>
                        <div class='modal-dialog image modal-dialog-centered'>
                            <div class='modal-content'>
                            <img src='data:image/png;base64,<?=base64_encode($it['imagem']) ?>' width='500px' title='' alt='<?=$it['nome']?>-<?=$it['marca']?>'>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
        <?php else: ?>
            <!-- card <?=$it['nome']?> <?=$it['marca']?> -->
            <form action="Home.php" method="post">
                <div class="container my-5 d-flex justify-content-center">
                    <div class='border p-5' id="div-image">
                        <a href='#imagem' data-bs-toggle='modal'><img class="" src='data:image/png;base64,<?=base64_encode($it['imagem']) ?>' width='500px' title='' alt='<?=$it['nome']?>-<?=$it['marca']?>'></a>
                        </div>
                    <div class="border px-5">
                        <input type="hidden" name="operacao" value="inserir">
                        <input type="hidden" name="p" value="<?=$it['idprodutos']?>">

                        <h2 class='py-3'><?=$it['nome']?> <?=$it['marca']?></h2>
                        <!-- descrição -->
                        <a class="text-decoration-none text-dark dropdown-toggle" data-bs-toggle="collapse" href="#collapseDescricao" role="" aria-expanded="false" aria-controls="collapseExample" id="descricaoProduto">Descrição</a>
                        <div class="collapse" id="collapseDescricao">
                            <div class="border p-3">
                                <?=$it['descricao']?><br>Quantidade: <?=$it['quantidade']?>
                            </div>
                        </div>
                        <h5 class='fw-bold fs-4 mt-3'><strong>R$ <?=$it['preco']?></strong></h5>
                        <div class='col-12 pt-3'>
                            <button type="submit" class='w-100 btn btn-primary'>Adquirir</button>
                        </div>
                    </div>
                </div>
                
                <!-- modal imagem <?=$it['nome']?> <?=$it['marca']?> -->
                <div>
                    <div class='modal fade' tabindex='-1' id='imagem'>
                        <div class='modal-dialog image modal-dialog-centered'>
                            <div class='modal-content'>
                            <img src='data:image/png;base64,<?=base64_encode($it['imagem']) ?>' width='500px' title='' alt='<?=$it['nome']?>-<?=$it['marca']?>'>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    <?php endif; 
    endforeach; 
endif;?>