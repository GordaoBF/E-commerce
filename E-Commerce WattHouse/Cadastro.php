<?php
    include "incs/topoADM.php";    
    require_once "src/CategoriaDAO.php";
    require_once "src/ProdutoDAO.php";
    require_once "src/UsuarioDAO.php";
    $produtoDAO = new ProdutoDAO();
    $usuarioDAO = new UsuarioDAO();
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    ?>
        <?php if (!isset($_GET['msg'])):  ?>
        <?php elseif (isset($_GET['msg']) && ($msg=='Usuario Cadastrado' || $msg=='Cliente Cadastrado' || $msg=='Produto Cadastrado')):  ?>
            <div class="alert alert-primary m-0 mb-3" role="alert">
                <?=$msg?>
            </div>
        <?php else: ?>
            <div class="alert alert-danger m-0 mb-3" role="alert">
                <?=$msg?>
            </div>
        <?php endif;?>
        <form method="POST" enctype="multipart/form-data" class="d-flex justify-content-evenly m-0 p-2">

            <div class="form-check ">
                <?php if (isset($_GET['tipo']) && $_GET['tipo']=='cliente'):?>
                <input type="radio" id="switch"  name='switch' onclick="checkedBtnList()" class="form-check-input " checked>
                <label for="switch" class="form-check-label">Cliente</label>
                <?php else: ?>
                <input type="radio" id="switch"  name='switch' onclick="checkedBtnList()" class="form-check-input ">
                <label for="switch" class="form-check-label">Cliente</label>
                <?php endif; ?>
            </div>
            
            <div class="form-check">
            <?php if (isset($_GET['tipo']) && $_GET['tipo']=='usuario'):?>
                <input type="radio" id="switch2" name='switch'  onclick="checkedBtnList()" class="form-check-input "checked>
                <label for="switch2" class="form-check-label ">Usuário</label>
            <?php else: ?>
                <input type="radio" id="switch2" name='switch'  onclick="checkedBtnList()" class="form-check-input ">
                <label for="switch2" class="form-check-label ">Usuário</label>
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

        <div class="usuario">
            <form method="POST" id="usuario" enctype="multipart/form-data" action="incs/Confirmacao.php?tipo=usuario&acao=cadastro" class="nmostrar container w-75">
                <h2  class="my-4 text-center">Cadastro de Usuarios</h2>
                

                <input type="hidden" id="switch" value="2" name="switch">

                <div class="mb-3">
                    <label for="idnome" class="form-label">Nome do Usuario</label>
                    <input type="text" name="nome" id="idnome" class="form-control us" >
                </div>

                <div class="mb-3">
                    <label for="idpreco" class="form-label">Login</label>
                    <input type="text" name="login" id="idlogin" class="form-control us" >
                </div>

                <div class="mb-3">
                    <label for="idmarca" class="form-label">Senha</label>
                    <input type="password" name="senha" minlength="4" id="idsenha" class="form-control us">
                </div>

                <div class="mb-3">
                    <label for="idquantidade" class="form-label">Confirmar Senha</label>
                    <input type="password" name="senha2" id="idsenha" minlength="4" class="form-control us" >
                </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
                
            </form>
        </div>
        
        <div class="produto">
            <form method="POST" id="produto" enctype="multipart/form-data" action="incs/Confirmacao.php" class="nmostrar container w-75">
            <h2 class="my-4 text-center">Cadastro de Produtos</h2>

                <input type="hidden" value="3" name="switch">

                <div class="mb-3">
                    <label for="idnome" class="form-label">Nome do produto</label>
                    <input type="text" name="nome" id="idnome" class="form-control pro" >
                </div>

                <div class="mb-3">
                    <label for="iddescricao" class="form-label">Descrição</label>
                    <textarea name="descricao" id="iddescricao" class="form-control pro" cols="30" rows="5"></textarea>
                </div>

                <!--categorias-->
                <div class="mb-3">
                    <label for="idcategoriasid" class="form-label">Categoria</label>
                    <select name="idcategorias" id="idcategoriasid" class="form-select pro" >
                        <?php
                            $categoriaDAO = new CategoriaDAO();
                            $categorias = $categoriaDAO->ConsultaCat();
                            foreach ($categorias as $categoria):
                        ?>
                        <option value='<?=$categoria['idcategorias']?>'><?=$categoria['categorias']?></option>
                        <?php endforeach;
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="idpreco" class="form-label">Preço</label>
                    <input type="number" name="preco" min='0' id="idpreco" class="form-control pro" >
                </div>

                <div class="mb-3">
                    <label for="idmarca" class="form-label">Marca</label>
                    <input type="text" name="marca" id="idmarca" class="form-control pro">
                </div>

                <div class="mb-3">
                    <label for="idquantidade" class="form-label">Quantidade em estoque</label>
                    <input type="number" name="quantidade" min="1" id="idquantidade" class="form-control pro" >
                </div>

                <div class="mb-3">
                    <label for="idimagem" class="form-label">Imagem</label>
                    <input type="file" name="imagem" id="idimagem" class="form-control pro" >
                </div>
                
                <div id="promocao" class="form-check">
                    <input type="checkbox" id="idpromocao" name="promocao" onclick="checkedBtn()" class="form-check-input ">
                    <label for="switch3" class="form-check-label fs-5">Promocao</label>
                    
                    <label for="iddesconto" id="desconto" class="form-label desconto">Desconto em %</label>
                    <input type="hidden" min="1" max="100" name="desconto" id="iddesconto" class="form-control mb-3">
                </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
                
            </form>
            
        </div>
        <div class="cliente w-100"  >
            <form method="POST" id="cliente"  enctype="multipart/form-data" action="incs/Confirmacao.php?tipo=usuario&acao=cadastro" class="nmostrar container w-75">
                <h2 class="my-4 text-center">Cadastro de Cliente</h2>

                <input type="hidden" value="1" name="switch">

                <div class="mb-3">
                    <label for="idnome" class="form-label">Nome do Usuario</label>
                    <input type="text" name="nome" id="idnome" class="form-control client" >
                </div>

                <div class="mb-3">
                    <label for="idpreco" class="form-label">Email</label>
                    <input type="Email" name="email" id="idlogin" class="form-control client" >
                </div>

                <div class="mb-3">
                    <label for="idmarca" class="form-label">Senha</label>
                    <input type="password" name="senha" minlength="4" id="idsenha" class="form-control client">
                </div>

                <div class="mb-3">
                    <label for="idquantidade" class="form-label">Confirmar Senha</label>
                    <input type="password" name="senha2" minlength="4" id="idsenha" class="form-control client" >
                </div>

                <div class="mb-3">
                    <label for="idquantidade" class="form-label">Nome Cartão</label>
                    <input type="text" name="nomecartao" id="idnome" class="form-control client" >
                </div>

                <div class="mb-3">
                    <label for="idquantidade" class="form-label">CPF</label>
                    <input type="number" name="cpf" maxlength="14" minlength="11" id="idcartao" class="form-control client" >
                </div>

                <div class="mb-3">
                    <label for="idquantidade" class="form-label">Números do cartão</label>
                    <input type="text" name="numeros" maxlength="16" id="idcartao" class="form-control client" >
                </div>

                <div class="mb-3">
                    <label for="idquantidade" class="form-label">3 Números</label>
                    <input type="number" name="3numeros" minlength="3" maxlength="3" id="idcartao" class="form-control client" >
                </div>
                
                <div class="mb-3">
                    <label for="idquantidade" class="form-label">Agência</label>
                    <input type="text" name="agencia" id="idcartao" class="form-control client" >
                </div>

                <div class="mb-3">
                    <label for="idquantidade" class="form-label">DATA</label>
                    <input type="text" name="data" minlength="4" maxlength="5" id="idcartao" class="form-control client" >
                </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
                    
            </form>
        </div>
    
    
    
    
<?php
    include "incs/rodapeADM.php";
?>