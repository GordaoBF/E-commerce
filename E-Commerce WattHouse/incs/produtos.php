<?php
$produtoDAO = new ProdutoDAO();
$conexaoBD = ConexaoBD::conectar();

if (!isset($_GET['chave']) && !isset($_GET['tipo'])) : ?>

    <p class='text-center fs-1 p-5 m-5'>Este produto não foi encontrado <br>¯\_(ツ)_/¯</p>

<?php elseif (isset($_GET['tipo']) || !isset($_GET['chave'])): ?>
        <!-- os cards -->
        <div class='row row-cols-md-3 row-cols-sm-2 g-4 mb-5 row-cols-lg-5 card-group m-5'>
            <?php 
            $produtos = ProdutoDAO::ConsultaTipo($_GET['tipo']);
                if (!is_null($produtos)) :
                    
                foreach ($produtos as $it) :
                    $res = ($it['preco'] - ($it['preco'] * ($it['desconto'] / 100)));
                    $rese = number_format($res, 2, ',', '.');
                    if ($it['promocao'] == 1) : ?>
                        <!-- Card <?php echo $it['nome']; ?> -->
                        <div class='col'>
                            <div class='card border position-relative'> 
                                <form action="<?=$server?>" method="post">
                                    <a href='Product.php?p=<?= $it['idprodutos'] ?>' id="verMais">
                                        <div class="card-h">
                                            <input type="hidden" name="operacao" value="inserir">
                                            <input type="hidden" name="p" value="<?=$it['idprodutos']?>">
                                            <img src='data:image/png;base64,<?= base64_encode($it['imagem']) ?>' class='p-2 card-img' alt='<?= $it['nome'] ?>'>
                                        </div>
                                    </a>
                                    <div class="card-b p-4 pb-0">
                                        <h5 class='text-center title'><?= $it['nome'] ?></h5>
                                        <p class='px-3 text-center fw-light title p-0 m-0'><span class='border px-2 text-light text-left bg-warning rounded-pill'><?=$it['desconto']?>% de desconto</span> <br><s><b>R$</b><?= number_format($it['preco'], 2, ',', '.') ?></s> <b>R$</b><?= $rese ?></p>
                                        <button type="submit" class='text-center btn but mt-2 btn-primary rounded-pill'>Adquirir</button> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php else : ?>
                        <!-- Card <?php echo $it['nome']; ?> -->
                        <div class='col'>
                            <div class='card border'>
                                <form action="<?=$server?>" method="post">
                                    <a href='Product.php?p=<?= $it['idprodutos'] ?>' id="verMais">
                                        <div class="card-h">
                                            <input type="hidden" name="operacao" value="inserir">
                                            <input type="hidden" name="p" value="<?=$it['idprodutos']?>">
                                            <img src='data:image/png;base64,<?= base64_encode($it['imagem']) ?>' class='p-2 card-img' alt='<?= $it['nome'] ?>'>
                                        </div>
                                    </a>
                                    <div class="card-b p-4 pb-0">
                                        <h5 class='text-center title'><?= $it['nome'] ?></h5>
                                        <p class='px-3 text-center fw-light title p-0 m-0'><span class=''><b>R$</b><?= number_format($it['preco'], 2, ',', '.') ?></p>
                                        <button type="submit" class='text-center btn but mt-2 btn-primary rounded-pill'>Adquirir</button> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endif; 
                endforeach;
            else: ?>
                <p class='text-center fs-1 p-5 m-5'>Este produto não foi encontrado <br>¯\_(ツ)_/¯</p>
        <?php endif; ?>
    <?php elseif ((!isset($_GET['tipo']) || isset($_GET['chave']))): ?>
    <!-- os cards -->
    <div class='row row-cols-md-3 row-cols-sm-2 g-4 mb-5 row-cols-lg-5 card-group m-5'>
        <?php 
        $produtos = ProdutoDAO::ConsultaChave($_GET['chave']);
            if (!is_null($produtos)) :
                
            foreach ($produtos as $it) :
                $res = ($it['preco'] - ($it['preco'] * ($it['desconto'] / 100)));
                $rese = number_format($res, 2, ',', '.');

                if ($it['promocao'] == 1) : ?>
                    <!-- Card <?php echo $it['nome']; ?> -->
                    <div class='col'>
                        <div class='card border position-relative'> 
                            <div class="card-h">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#img<?=$it['idprodutos']?>">
                                    <img src='data:image/png;base64,<?=base64_encode($it['imagem']) ?>' class='p-2 card-img' alt='<?= $it['nome'] ?>'>
                                </button>
                            </div>
                            <div class="card-b p-4 pb-0">
                                <h5 class='text-center title'><?= $it['nome'] ?></h5>
                                <p class='px-3 text-center fw-light title p-0 m-0'><span class='border px-2 text-light text-left bg-warning rounded-pill'><?=$it['desconto']?>% de desconto</span> <s><b>R$</b><?= number_format($it['preco'], 2, ',', '.') ?></s> <b>R$</b><?= $rese ?></p>
                                <a class='link text-light' href='Product.php?p=<?= $it['idprodutos'] ?>'><p class='text-center but mt-2 btn btn-primary rounded-pill'>Ver mais</p></a>
                            </div>
                        </div>
                    </div>
                    <!-- Modal <?php echo $it['nome']; ?> -->
                    <div class="modal fade" id="img<?=$it['idprodutos']?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <img src='data:image/png;base64,<?=base64_encode($it['imagem']) ?>' class='p-2 card-img' alt='<?= $it['nome'] ?>'>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <!-- Card <?php echo $it['nome']; ?> -->
                    <div class='col'>
                        <div class='card border'>
                            <div class="card-h">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#img<?= $it['idprodutos'] ?>">
                                    <img src='data:image/png;base64,<?= base64_encode($it['imagem']) ?>' class='p-2 card-img' alt='<?= $it['nome'] ?>'>
                                </button>
                            </div>
                            <div class="card-b p-4 pb-0">
                                <h5 class='text-center title'><?= $it['nome'] ?></h5>
                                <p class='px-3 text-center fw-light title p-0 m-0'><span class=''><b>R$</b><?= number_format($it['preco'], 2, ',', '.') ?></p>
                                <a class='link text-light' href='Product.php?p=<?= $it['idprodutos'] ?>'>
                                    <p class='text-center but mt-2 btn btn-primary rounded-pill'>Ver mais</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Modal <?php echo $it['nome']; ?> -->
                    <div class="modal fade" id="img<?= $it['idprodutos'] ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <img src='data:image/png;base64,<?= base64_encode($it['imagem']) ?>' class='p-2 card-img' alt='<?= $it['nome'] ?>'>
                            </div>
                        </div>
                    </div>
                <?php endif; 
            endforeach;
        else: ?>
            <p class='text-center fs-1 p-5 m-5'>Este produto não foi encontrado <br>¯\_(ツ)_/¯</p>
    <?php endif; ?>
<?php endif;?>