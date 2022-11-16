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
            <div class="navbar" id="logo">
                <a href="Home.php"><img src="img/WATTHOUSE_White.png" alt="WattHouse"></a>
            </div>
            <!-- barra de pesquisa -->
            <div class="navbar w-100">
                <form class="w-100 d-flex flex-row-reverse" action="Items.php">
                    <input class="form-control rounded-pill py-3 me-2 search" name="chave" type="search" placeholder="Pesquisar" aria-describedby="search-button">
                </form>
            </div>
            <!-- Icones Offcanva e modais -->
            <div class="d-flex col-2">
                <nav class="navbar navbar-light">
                    <div class="container-fluid">
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
                                                    <p class="text-center px-2 m-0"><?= $car['quantidade'] ?></p>
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
                                <!-- total -->
                                <p class="">TOTAL: R$ <?= number_format($total, 2, ",", ".") ?></p>
                                <div class="col-12">
                                    <form action="<?= $server ?>" class="float-start" method="post">
                                        <input type="hidden" name="operacao" value="limpar">
                                        <button type='submit' class="btn btn-secondary">Esvaziar Carrinho</button>
                                    </form>
                        <?php if (!isset($_SESSION['cliente'])) : ?>
                                    <form action="incs/LoginConfirm.php" class="float-end" method="post">
                                        <input type="hidden" name="cliente" value="<?= $_SESSION['cliente']??1; ?>">
                                        <input type="hidden" name="server" value="<?=$server?>">
                                        <button type='submit' class="btn btn-primary">Finalizar Compra</button>
                                    </form>
                        <?php else : ?>
                                    <a role='button' data-bs-toggle="offcanvas" data-bs-target="#offFinalizar" class="btn btn-success float-end" type="submit">Finalizar Compra</a>
                        <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['cliente'])) : ?>
                            <!-- offcanvas finalizar compra -->
                            <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offFinalizar">
                            <form action="" class="row m-0 p-0" method="post">
                                <div class="offcanvas-header">
                                    <h2 class="text-center">Finalizar Compra</h2>
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                    <div class="offcanvas-body d-flex h-100">
                                        <div class="col-6" id="verify">
                                            <div class="row bg-warning pt-5">
                                                <h2 class="text-center">DADOS DO CLIENTE</h2>
                                                <?php $cl = ClienteDAO::ConsultaID($_SESSION['cliente']) ?>

                                                <div class="col-6">
                                                    <label for="idnome" class="form-label">Nome do Titular</label>
                                                    <input disabled type="text" name="nomecartao" value='<?= $cl['nomecartao'] ?>' id="idnome" class="form-control client">
                                                </div>

                                                <div class="col-6">
                                                    <label for="idquantidade" class="form-label">CPF</label>
                                                    <input disabled type="number" name="cpf" maxlength="14" minlength="11" value='<?= $cl['cpf'] ?>' class="form-control client">
                                                </div>

                                                <div class="col-5">
                                                    <label for="idquantidade" class="form-label">Números do cartão</label>
                                                    <input disabled type="text" name="numeros" maxlength="16" value='<?= $cl['numeros'] ?>' class="form-control client">
                                                </div>

                                                <div class="col-2">
                                                    <label for="idquantidade" class="form-label">3 Números</label>
                                                    <input disabled type="number" name="3numeros" minlength="3" maxlength="3" value='<?= $cl['3numeros'] ?>' class="form-control client">
                                                </div>

                                                <div class="col-2">
                                                    <label for="idquantidade" class="form-label">Agência</label>
                                                    <input disabled type="text" name="agencia" value='<?= $cl['agencia'] ?>' class="form-control client">
                                                </div>

                                                <div class="col-3">
                                                    <label for="idquantidade" class="form-label">Data</label>
                                                    <input disabled type="text" name="data" minlength="4" maxlength="5" value='<?= $cl['data'] ?>' class="form-control client">
                                                </div>
                                                <div class="d-flex">
                                                    <p class="mx-2">Nome: <?=$cl['nome']?></p>
                                                    <p class="mx-2">Email: <?=$cl['email']?></p>
                                                    <p class="mx-2">Endereço: <?=$cl['endereco']?></p>
                                                </div>
                                                <h4>DADOS DA COMPRA</h4>
                                                    <p>Valor: R$ <?=number_format($_SESSION['total'],2,",",".")?></p>
                                            </div>
                                        </div>
                                        <div class="col-4 separator">
                                            <div class="bg-warning" id="fin">
                                            
                                            </div>
                                            <div class="embaixo">
                                                <button type="submit" class="float-end btn btn-primary">Pagar</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            
                            <?php endif; ?>
                        <!-- botão modal login -->
                        <a href="#login" role="button" class="text-light text-decoration-none pe-3" data-bs-toggle="modal"><img src="img/profile-icon.png" alt="" width="35px" title="Fazer login"></a>
                        <!-- botao do carrinho -->
                        <div>
                            <a href="#offCarrinho" class="m-0 p-0 position-relative" data-bs-toggle="offcanvas"><img src="img/shopping-cart.png" alt="" width="35px" title="Carrinho">
                                <span class="position-absolute top-0 start-100 translate-middle badge text-dark rounded-pill bg-light">
                                    <?php echo sizeof($carrinho) ?>
                                    <span class="visually-hidden">Carrinho de Comprar</span>
                                </span>
                            </a>
                        </div>
                        <!-- modal Login -->
                        <div>
                            <div class="modal fade" id="login" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" >
                                    <div class="modal-content" id="loginModal">
                                        <h1 class="text-center fs-1 my-5">Login</h1>
                                        <form action="incs/LoginConfirm.php" class="w-100 px-5" method="post">

                                            <label for="" class="form-label">Email:</label>    
                                            <input type="text" class="form-control mb-5" name='email' placeholder="Email">
                                            <input type="hidden" name='server' value="<?=$server?>">
                                            <label for="" class="form-label">Senha:</label>
                                            <input class="form-control mb-5" type="password" name="senha" placeholder="Senha">

                                            <a class="btn" data-bs-toggle='modal' data-bs-target="#cadastro">Fazer cadastro</a>
                                            <button type="submit" class="btn btn-primary float-end mb-5">Confirmar</button>

                                        </form>
                                        <?php if(isset($_REQUEST['msg'])):?>
                                            <div class="alert alert-danger mx-4">
                                                <?=$_REQUEST['msg']?>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- modal Cadastro -->
                        <div>
                            <div class="modal fade" id="cadastro" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" >
                                    <div class="modal-content" id="cadastroModal">
                                        <h1 class="text-center fs-1 my-5">Cadastro</h1>
                                        <form class="mx-5 row mb-4" method="POST" enctype="" action="incs/Confirmacao.php?acao=cadastro">
                                            <div class="mb-3 col-6">
                                                <label for="idnome" class="form-label">Nome do Usuario</label>
                                                <input type="text" name="nome" id="idnome" class="form-control client" >
                                            </div>

                                            <div class="mb-3 col-6">
                                                <label for="idpreco" class="form-label">Email</label>
                                                <input type="Email" name="email" id="idlogin" class="form-control client" >
                                            </div>

                                            <div class="mb-3 col-4">
                                                <label for="idmarca" class="form-label">Senha</label>
                                                <input type="password" name="senha" minlength="4" id="idsenha" class="form-control client">
                                            </div>

                                            <div class="mb-3 col-4">
                                                <label for="idquantidade" class="form-label">Confirmar Senha</label>
                                                <input type="password" name="senha2" minlength="4" id="idsenha" class="form-control client" >
                                            </div>

                                            <div class="mb-3 col-4">
                                                <label for="idquantidade" class="form-label">Nome Cartão</label>
                                                <input type="text" name="nomecartao" id="idnome" class="form-control client" >
                                            </div>

                                            <div class="mb-3 col-3">
                                                <label for="idquantidade" class="form-label">CPF</label>
                                                <input type="number" name="cpf" maxlength="14" minlength="11" id="idcartao" class="form-control client" >
                                            </div>

                                            <div class="mb-3 col-3">
                                                <label for="idquantidade" class="form-label">Números do cartão</label>
                                                <input type="text" name="numeros" maxlength="16" id="idcartao" class="form-control client" >
                                            </div>

                                            <div class="mb-3 col-2">
                                                <label for="idquantidade" class="form-label">3 Números</label>
                                                <input type="number" name="3numeros" minlength="3" maxlength="3" id="idcartao" class="form-control client" >
                                            </div>
                                            
                                            <div class="mb-3 col-2">
                                                <label for="idquantidade" class="form-label">Agência</label>
                                                <input type="text" name="agencia" id="idcartao" class="form-control client" >
                                            </div>

                                            <div class="mb-3 col-2">
                                                <label for="idquantidade" class="form-label">DATA</label>
                                                <input type="text" name="data" minlength="4" maxlength="5" id="idcartao" class="form-control client" >
                                            </div>
                                                
                                            <input type="hidden" value="1" name="switch">
                                            <input type="hidden" value="<?=$server?>" name="server">

                                            <div>
                                                <a class="btn" data-bs-toggle='modal' data-bs-target="#login">Fazer login</a>
                                                <button type="submit" class="btn btn-primary float-end mb-2">Confirmar</button>
                                            </div>
                                        </form>
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