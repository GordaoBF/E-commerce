<?php
    include "incs/topoADM.php";    
    require_once "src/CategoriaDAO.php";
    require_once "src/ProdutoDAO.php";
    require_once "src/UsuarioDAO.php";
    require_once "src/ClienteDAO.php";
    require_once "src/CartaoDAO.php";

    $produtoDAO = new ProdutoDAO();
    $usuarioDAO = new UsuarioDAO();
    $clienteDAO = new ClienteDAO();
    $cartaoDAO = new CartaoDAO();
    
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    ?>  
        <?php if (!isset($_GET['msg'])):  ?>
        <?php elseif (isset($msg) && ($msg=='Usuario Cadastrado' || $msg=='Cliente Cadastrado' || $msg=='Produto Cadastrado' || $msg=='Produto Removido' || $msg=='Cliente Removido' || $msg=='Usuario Removido')):  ?>
            <div class="alert alert-primary m-0 mb-3" role="alert">
                <?=$msg?>
            </div>
        <?php endif; 
        ?>
        <form method="POST" enctype="multipart/form-data" class="d-flex justify-content-evenly m-0 p-3">

            <div class="form-check ">
            <?php if (isset($_GET['tipo']) && $_GET['tipo']=='cliente'):?>
                <input type="radio" id="switch"  name='switch' onclick="checkedBtnList()" class="form-check-input " checked>
                <label for="switch" for="switch" class="form-check-label">Cliente</label>
            <?php else: ?>
                <input type="radio" id="switch"  name='switch' onclick="checkedBtnList()" class="form-check-input ">
                <label for="switch" for="switch" class="form-check-label">Cliente</label>
            <?php endif; ?>
            </div>
            
            <div class="form-check ">
            <?php if (isset($_GET['tipo']) && $_GET['tipo']=='usuario'):?>
                <input type="radio" id="switch2" name='switch'  onclick="checkedBtnList()" class="form-check-input "checked>
                <label for="switch2" for="switch2" class="form-check-label ">Usuário</label>
            <?php else: ?>
                <input type="radio" id="switch2" name='switch'  onclick="checkedBtnList()" class="form-check-input ">
                <label for="switch2" for="switch2" class="form-check-label">Usuário</label>
            <?php endif; ?>
            </div>

            <div class="form-check">
            <?php if (isset($_GET['tipo']) && $_GET['tipo']=='produto'):?>
                <input type="radio" id="switch3" name='switch'  onclick="checkedBtnList()" class="form-check-input " checked>
                <label for="switch3" class="form-check-label ">Produto</label>
            <?php else: ?>
                <input type="radio" id="switch3" name='switch'  onclick="checkedBtnList()" class="form-check-input ">
                <label for="switch3" class="form-check-label ">Produto</label>
            <?php endif; ?>
            </div>
        </form>

        <div class="usuario nmostrar"id='usuario'>
        <form class="container p-3 w-50 border rounded my-3">
        <div class="mb-2">
            <label for="form-label" class="">Busca por Nome/Login</label>
            <input type="text" name="chave" value="<?php if(isset($_GET['chave']) && isset($_GET['tipo']) && ($_GET['tipo']=='usuario'))
            {echo $_GET['chave'];}else{}?>" class="form-control">
            <input type="hidden" name="tipo" value="usuario" class="form-control">
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
            <a role="button" href="Lista.php"><button class="btn btn-secondary">Limpar</button></a>
        </div>
        </form>

        <?php 
        if(isset($_GET['chave']) && isset($_GET['tipo']) && ($_GET['tipo']=='usuario')){
                $usuarios = $usuarioDAO->ConsultaChave($_GET['chave']);
            }else{
                $usuarios = $usuarioDAO->ConsultaTodos();
            }
            if ($usuarios==null):
        ?>

            <p class='text-center fs-1 p-5 m-5'>Este Usuario não foi encontrado <br>¯\_(ツ)_/¯</p>

        <?php else: ?>

            <div id="usuario" class="lista">
                <table class="w-100 lista">
                    <tr>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Senha</th>
                        <th>ação</th>
                    </tr>
                    <?php
                    
                    

                    foreach ($usuarios as $us):
                    ?>
                    <tr>
                        <td class='decri'><?= $us['nome'] ?></td>
                        <td class='decri'><?= $us['login'] ?></td>
                        <td class='decri'><?= $us['senha'] ?></td>
                        <td>
                            <a href="Confirmacao.php?acao=remover&p=<?= $us['idusuarios'] ?>&tipo=usuario" class="btn btn-danger btn-sm">Remover</a>
                            <a href="Editar.php?acao=editar&p=<?= $us['idusuarios'] ?>&tipo=usuario" class="btn btn-success btn-sm">Editar</a>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </table>
            </div>

        <?php endif;?>
        </div>
        
        <div class="produto nmostrar" id="produto">
            <form class="container w-50 border rounded p-3 my-3">
            <div class="mb-2">
                <label for="form-label" class="">Busca por Nome/Marca</label>
                <input type="text" name="chave" value="<?php if(isset($_GET['chave']) && isset($_GET['tipo']) && ($_GET['tipo']=='produto'))
                {echo $_GET['chave'];}else{}?>" class="form-control">
                <input type="hidden" name="tipo" value="produto" class="form-control">
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
                <a role="button" href="Lista.php"><button class="btn btn-secondary">Limpar</button></a>
            </div>
        </form>

        <?php
            if(isset($_GET['chave']) && isset($_GET['tipo']) && ($_GET['tipo']=='produto')){
                $produtos = $produtoDAO->ConsultaChave($_GET['chave']);
            }else{
                $produtos = $produtoDAO->ConsultaTodos();
            }
            if ($produtos==null):  
        ?>
            <p class='text-center fs-1 p-5 m-5'>Este Produto não foi encontrado <br>¯\_(ツ)_/¯</p>
        <?php else: ?>

        <div class="lista">
            <table class="w-100 ">
                <tr>
                    <th>Nome</th>
                    <th>descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Marca</th>
                    <th>Promocao</th>
                    <th>Desconto em %</th>
                    <th>Imagem</th>
                    <th>ação</th>
                </tr>
                <?php

                foreach ($produtos as $produto) :

                ?>
                
                <tr>
                    <td class="decri"><?= $produto['nome'] ?></td>
                    <td class="decri"><?= $produto['descricao'] ?></td>
                    <td>R$ <?=number_format($produto['preco'],2,',','.') ?></td>
                    <td><?= $produto['categorias'] ?></td>
                    <td><?= $produto['quantidade'] . " und" ?></td>
                    <td class="decri"><?= $produto['marca'] ?></td>
                    <td><?php if ($produto['promocao'] == 1) {
                                echo "sim";
                            } else {
                                echo "Não";
                            } ?></td>
                    <td><?php if (!is_null($produto['desconto'])) {
                                echo $produto['desconto'] . "%";
                            } else {
                                echo "0%";
                            } ?></td>
                    <td class="img-car">
                        <img src='data:image/png;base64,<?= base64_encode($produto['imagem']) ?>' id='' class='w-100' alt=''>
                    </td>
                    <td>
                        <!--<a href="" class="btn btn-success btn-sm">Editar</a>-->
                        <a href="Confirmacao.php?acao=remover&p=<?= $produto['idprodutos'] ?>&tipo=produto"
                            class="btn btn-danger btn-sm">Remover</a>
                        <a href="Editar.php?acao=editar&p=<?= $produto['idprodutos'] ?>&tipo=produto"
                            class="btn btn-success btn-sm">Editar</a>
                    </td>
                </tr>
                
                <?php endforeach; ?>
                
            </table>
        </div>
        <?php endif;?>
            
        </div>
        <div class="cliente nmostrar" id="cliente" >
        <form class="container w-50 p-3 border rounded my-3">
        <div class="mb-2">
            <label for="form-label" class="">Busca por Nome/Email</label>
            <input type="text" name="chave" value="<?php if(isset($_GET['chave']) && isset($_GET['tipo']) && ($_GET['tipo']=='cliente'))
            {echo $_GET['chave'];}else{}?>" class="form-control">
            <input type="hidden" name="tipo" value="cliente" class="form-control">
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
            <a role="button" href="Lista.php"><button type="reset" class="btn btn-secondary">Limpar</button></a>
        </div>
        </form>

        <?php 
        if(isset($_GET['chave']) && isset($_GET['tipo']) && ($_GET['tipo']=='cliente')){
                $clientes = $clienteDAO->ConsultaChave($_GET['chave']);
            }else{
                $clientes = $clienteDAO->ConsultaTodos();
            }
            if ($clientes==null):
        ?>

            <p class='text-center fs-1 p-5 m-5'>Este Usuario não foi encontrado <br>¯\_(ツ)_/¯</p>

        <?php else: ?>

            <div id="cliente" class="lista">
                <table class="w-100 lista">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Senha</th>
                        <th>CPF</th>
                        <th>Idcartao</th>
                        <th>ação</th>
                    </tr>
                    <?php
                    
                    

                    foreach ($clientes as $cl):
                    ?>
                    <tr>
                        <td class='decri'><?= $cl['nome'] ?></td>
                        <td class='decri'><?= $cl['email'] ?></td>
                        <td class='decri'><?= $cl['senha'] ?></td>
                        <td class='decri'><?= $cl['cpf'] ?></td>
                        <td class='decri'><?= $cl['idcartao'] ?></td>
                        <td>
                            <a href="Confirmacao.php?acao=remover&p=<?= $cl['idclientes'] ?>&tipo=cliente" class="btn btn-danger btn-sm">Remover</a>
                            <a href="Editar.php?acao=editar&p=<?= $cl['idclientes'] ?>&tipo=cliente" class="btn btn-success btn-sm">Editar</a>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </table>
            </div>

        <?php endif;?>
    
<?php
    include "incs/rodapeADM.php";
?>