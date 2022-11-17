<?php
include "incs/topo.php";
?>
<!-- carrosel de destaques -->
<div id="destaque" class="carousel slide mb-5" data-bs-ride="carousel">
    <!-- icone de indicação -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#destaque" data-bs-slide-to="0" class="active border rounded-pill" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" class="border rounded-pill" data-bs-target="#destaque" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <!-- carrosel items -->
    <div class="carousel-inner" id="destaque">
        <div class="carousel-item active">
            <img src="img/Promocao-1.png" class="" alt="Promocao de Geladeira">
        </div>
        <div class="carousel-item">
            <img src="img/bannerfretegratis.png" class="" alt="Promocao de frete">
        </div>
    </div>
    <!-- botões de do carrosel -->
    <div class="carousel-control">
        <button class="carousel-control-prev" type="button" data-bs-target="#destaque" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#destaque" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
</div>
<!-- Slide de Promocão-->
<div id="promo" class="carousel slide container-fluid" data-bs-ride="carousel">  
    <div class="carousel-control-left">
        <button class="carousel-control-prev" type="button" data-bs-target="#promo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
    </div>
    <div class="carousel-control-right">
        <button class="carousel-control-next" type="button" data-bs-target="#promo" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- carrosel items --> 
    <div class="carousel-inner container" id="promo-inner">
        <?php
        for ($i = 1; $i <= 5; $i++) :
            $produtos = ProdutoDAO::ConsultaTipoPromo($i);
            $n = $i;
            $s=0;
            if ($i == 1) :
        ?>
        <!-- Conjunto de items <?=$n?> -->
        <div class="carousel-item active">
            <div class="row row-cols-sm-2 row-cols-lg-5 mx-2 g-4 py-3 card-group">
                <?php foreach ($produtos as $it): $s++;?>
                <!-- Item <?=$s?> do conjunto <?=$n?> -->
                <div class="col promo">
                    <div class="card card-promo">
                        <a href="Product.php?p=<?= $it['idprodutos'] ?>"><img src='data:image/png;base64,<?= base64_encode($it['imagem']) ?>' class="card-img rounded" alt=""></a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
        <!-- Conjunto de items <?=$n?> -->
        <div class="carousel-item">
            <div class="row row-cols-sm-2 row-cols-lg-5 mx-2 g-4 py-3 card-group">
                <?php foreach ($produtos as $it): $s++;?>
                <!-- Item <?=$s?> do conjunto <?=$n?> -->
                <div class="col promo">
                    <div class="card card-promo">
                        <a href="Product.php?p=<?= $it['idprodutos'] ?>"><img src='data:image/png;base64,<?= base64_encode($it['imagem']) ?>' class="card-img rounded" alt=""></a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; endfor;?>
    </div>

    <!-- icone de indicação -->
    <div class="carousel-indicators mt-3">
        <?php for ($i = 1; $i <= 5; $i++): $n = $i-1; if($i == 1):  ?>
            <button type="button" data-bs-target="#promo" data-bs-slide-to="<?=$n;?>" class="active border rounded-pill" aria-current="true" aria-label="Slide <?=$i?>"></button>
        <?php else:?>
            <button type="button" class="border rounded-pill" data-bs-target="#promo" data-bs-slide-to="<?=$n;?>" aria-label="Slide <?=$i?>"></button>    
        <?php endif; endfor;?>
    </div>
</div>
<!-- cards normais -->
<div class="container">
    <h4 class='text-dark text-center pb-5'>ITENS NORMAL</h4>
    <div class="row row-cols-md-3 row-cols-lg-5 mb-5 g-4 card-group">
        <?php
        $produtos = ProdutoDAO::ConsultaTodos();
        
        foreach ($produtos as $it) :
            if ($it['promocao'] == 0) :
        ?>
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
        <?php endif; endforeach; ?>
    </div>
</div>

<?php include "incs/rodape.php"; ?>