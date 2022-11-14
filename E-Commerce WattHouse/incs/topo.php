<?php
session_start();
require_once "src/ConexaoBD.php";
require_once "src/ProdutoDAO.php";
require_once "src/CategoriaDAO.php";
require_once "src/UsuarioDAO.php";
require_once "src/ClienteDAO.php";
$server = $_SERVER['REQUEST_URI'];
$title = $_SERVER['PHP_SELF'];
include "incs/ValidarSessao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Titulo -->
    <title><?php include "incs/title.php" ?></title>

    <!-- Coisas -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- links  -->
    <link rel="icon" href="img/logo.ico" type="image/icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body class="m-0 p-0">
    <!-- cabeçalho -->
    <header id="header">
        <!-- parte de cima do header -->
        <div class="container d-flex justify-content-between" id="cima">
            <!-- logo e botão -->
            <div class="navbar col-2">
                <a href="Home.php"><img src="img/WATTHOUSE_White.png" alt="WattHouse" width="150px" height="150px"></a>
            </div>
            <!-- barra de pesquisa -->
            <div class="navbar col-9">
                <form class="w-100 d-flex flex-row-reverse" action="Items.php">
                    <input class="form-control rounded-pill py-3 me-2 search" name="chave" type="search" placeholder="Pesquisar" aria-describedby="search-button">
                </form>
            </div>
            <!-- Icones Offcanva e modais -->
            <div class="d-flex col-2">
                <nav class="navbar navbar-light">
                    <div class="container-fluid">
                        <!-- botão modal login -->
                        <a href="#login" role="button" class="text-light text-decoration-none pe-3" data-bs-toggle="modal"><img src="img/profile-icon.png" alt="" width="35px" title="Fazer login"></a>

                        <!-- offcanva carrinho compras -->
                        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offCarrinho" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrinho</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <?php

                                $id = $_REQUEST['p'] ?? null;
                                $op = $_REQUEST['operacao'] ?? null;

                                $carrinho = $_SESSION['carrinho'] ?? [];

                                if ($op == 'inserir') {
                                    $ex = false;
                                    foreach ($carrinho as $car => $it) {
                                        if ($id == $it['idprodutos']) {
                                            $it['quantidade']++;
                                            $carrinho[$car] = $it;
                                            $ex = true;
                                        }
                                    }
                                    if ($ex == false) {
                                        $item['idprodutos'] = $id;
                                        $item['quantidade'] = 1;
                                        $carrinho[] = $item;
                                    }
                                } elseif ($op == "remover") {
                                    for ($i = 0; $i <= array_key_last($carrinho); $i++) {
                                        $item = $carrinho[$i] ?? null;
                                        if ($item != null && $item['idprodutos'] == $id) {
                                            unset($carrinho[$i]);
                                        }
                                    }
                                } elseif ($op == "limpar") {
                                    for ($i = 0; $i <= array_key_last($carrinho); $i++) {
                                        unset($carrinho[$i]);
                                    }
                                } elseif ($op == "retirar") {
                                    foreach ($carrinho as $car => $it) {
                                        if ($id == $it['idprodutos']) {
                                            $it['quantidade']--;
                                            if ($it['quantidade'] == 0) {
                                                unset($carrinho[$car]);
                                            } else {
                                                $carrinho[$car] = $it;
                                            }
                                        }
                                    }
                                }

                                $_SESSION['carrinho'] = $carrinho; ?>

                                <div class="lista">
                                    <table class="w-100 table-striped table">
                                        <tr>
                                            <th>Foto</th>
                                            <th>Nome</th>
                                            <th>Qtd</th>
                                            <th>Preço</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>


                                        <?php
                                        $produtoDAO = new ProdutoDAO();
                                        $sub = 0;
                                        $total = 0;

                                        foreach ($carrinho as $car) :
                                            $it = $produtoDAO->ConsultaID($car['idprodutos']);
                                            $sub = $car['quantidade'] * $it['preco'];
                                            $total += $sub; ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <div class="img-car">
                                                        <img src='data:image/png;base64,<?= base64_encode($it['imagem']) ?>'>
                                                    </div>
                                                </td>
                                                <td class="align-middle"><?= $it['nome'] ?></td>
                                                <td class="align-middle">
                                                    <div class="input-group">
                                                        <form action="<?= $server ?>" class='input-group-text p-0 m-0' method="post"><input type="hidden" name="p" value="<?= $it['idprodutos'] ?>"><input type="hidden" name="operacao" value="retirar"><button type="submit" class="btn w-100">-</button></form>
                                                        <p class="text-center input-group-text align-middle px-2 m-0"><?= $car['quantidade'] ?></p>
                                                        <form action="<?= $server ?>" class='input-group-text p-0 m-0' method="post"><input type="hidden" name="p" value="<?= $it['idprodutos'] ?>"><input type="hidden" name="operacao" value="inserir"><button type="submit" class="btn">+</button></form>
                                                    </div>
                                                </td>
                                                <td class="align-middle">R$ <?= number_format($it['preco'], 2, ",", ".") ?></td>
                                                <td class="align-middle">R$ <?= number_format($sub, 2, ',', '.') ?></td>
                                                <td class="align-middle">
                                                    <form action="<?= $server ?>" method="post">
                                                        <input type="hidden" name="operacao" value="remover">
                                                        <input type="hidden" name="p" value="<?= $it['idprodutos'] ?>">
                                                        <button type='submit' class="btn btn-danger">Remover</button>
                                                    </form>
                                                </td>
                                            </tr>

                                        <?php endforeach; ?>
                                    </table>

                                </div>
                                <?php $_SESSION['total'] = $total; ?>
                                <table class="table">
                                    <tr>
                                        <th>
                                            <p class="">TOTAL: R$ <?= number_format($total, 2, ",", ".") ?></p>
                                        </th>
                                    </tr>
                                </table>



                                <div class="col-12">
                                    <form action="<?= $server ?>" class="float-start" method="post">
                                        <input type="hidden" name="operacao" value="limpar">
                                        <button type='submit' class="btn btn-secondary">Esvaziar Carrinho</button>
                                    </form>
                                    <form action="incs/LoginConfirm.php" class="float-end" method="post">
                                        <input type="hidden" name="cliente" value="<?= $_SESSION['cliente']??null;?>">
                                        <button type='submit' class="btn btn-primary">Finalizar Compra</button>
                                    </form>
                                    <!-- <a role='button' data-bs-toggle="offcanvas" data-bs-target="#offFinalizar" class="btn btn-success float-end" type="submit">Finalizar Compra</a> -->
                                </div>
                            </div>

                        </div>
                        <!-- botao do carrinho -->
                        <div>
                            <a href="#offCarrinho" class="m-0 p-0 position-relative" data-bs-toggle="offcanvas"><img src="img/shopping-cart.png" alt="" width="35px" title="Carrinho">
                                <span class="position-absolute top-0 start-100 translate-middle badge text-dark rounded-pill bg-light">
                                    <?php echo sizeof($carrinho) ?>
                                    <span class="visually-hidden">Carrinho de Comprar</span>
                                </span>
                            </a>
                        </div>
                        <!-- offcanvas finalizar compra -->
                        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offFinalizar">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title">Offcanvas bottom</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body d-flex justify-content-between bg-danger">
                                <div class="col-7 bg-warning">
                                    <div id="verify">
                                        <form action="" method="post" class="row">
                                            <?php
                                            if (isset($_SESSION['cliente'])) :
                                                $cl = ClienteDAO::ConsultaID($_SESSION['cliente']) ?>
                                                <div class="col-6">
                                                    <label for="idnome" class="form-label">Nome do Titular</label>
                                                    <input type="text" name="nomecartao" value='<?= $cl['nomecartao'] ?>' id="idnome" class="form-control client">
                                                </div>

                                                <div class="col-6">
                                                    <label for="idquantidade" class="form-label">CPF</label>
                                                    <input type="number" name="cpf" maxlength="14" minlength="11" id="idcartao" class="form-control client">
                                                </div>

                                                <div class="col-5">
                                                    <label for="idquantidade" class="form-label">Números do cartão</label>
                                                    <input type="text" name="numeros" maxlength="16" id="idcartao" class="form-control client">
                                                </div>

                                                <div class="col-2">
                                                    <label for="idquantidade" class="form-label">3 Números</label>
                                                    <input type="number" name="3numeros" minlength="3" maxlength="3" id="idcartao" class="form-control client">
                                                </div>

                                                <div class="col-2">
                                                    <label for="idquantidade" class="form-label">Agência</label>
                                                    <input type="text" name="agencia" id="idcartao" class="form-control client">
                                                </div>

                                                <div class="col-3">
                                                    <label for="idquantidade" class="form-label">DATA</label>
                                                    <input type="text" name="data" minlength="4" maxlength="5" id="idcartao" class="form-control client">
                                                </div>
                                            <?php endif; ?>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-4 bg-warning">
                                    <div class="separator"></div>
                                    <button type="submit">Finalizar Compra</button>
                                </div>
                            </div>
                        </div>
                        <!-- modal Login -->
                        <div>
                            <div class="modal fade" id="login" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" id="loginModal">
                                        <div class="modal-header">
                                            <h1 class="fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- modal Cadastro -->
                        <div>
                            <div class="modal fade" tabindex="-1" id="cadastro">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" id="cadastromodal">
                                        <div class="col-12">
                                            <h1 class="text-center text-light py-3">Cadastro</h1>
                                            <form class="mx-5 mb-4">

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

        </div>
        <hr class="text-light border container-fluid">
        <!-- Parte de baixo -->
        <div class="container pb-3">
            <ul class="list-unstyled text-center nav justify-content-center ">
                <?php
                $categoria = CategoriaDAO::ConsultaCat();
                foreach ($categoria as $cat) : ?>
                    <li class='px-5 mx-3 nav-item'><a href='items.php?tipo=<?= $cat['idcategorias'] ?>' class='text-decoration-none text-light '><?= $cat['categorias'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </header>

    <!-- Meião do site -->
    <main>