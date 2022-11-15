<?php
include "incs/topoADM.php";    
require_once "src/CategoriaDAO.php";
require_once "src/ProdutoDAO.php";
require_once "src/UsuarioDAO.php";
require_once "src/ClienteDAO.php";

$produtoDAO = new ProdutoDAO();
$usuarioDAO = new UsuarioDAO();
$clienteDAO = new ClienteDAO();
$categoriaDAO = new CategoriaDAO();
?>
    <?php if(isset($_GET['tipo']) && ($_GET['tipo']=='produto')): 
        $it = $produtoDAO->ConsultaID($_GET['p']);?>

        <h2 class="mb-4 text-center">Alterar Produto</h2>
    <form method="POST" enctype="multipart/form-data" action="incs/Confirmacao.php?tipo=produto&acao=editar" class="container w-75 p-4">
        <input type="hidden" name='p' value="<?=$it['idprodutos']?>">
        <div class="mb-3">
            <label for="idnome" class="form-label">Nome do produto</label>
            <input type="text" name="nome" id="idnome" value="<?=$it['nome']?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="iddescricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="iddescricao" class="form-control" value='<?=$it['idprodutos']?>' cols="30" rows="5" required><?=$it['descricao']?></textarea>
        </div>

        <!--categorias-->
        <div class="mb-3">
            <label for="idcategoriasid" class="form-label">Categoria</label>
            <select name="idcategorias" id="idcategoriasid" value="<?=($it['idcategorias'])?>" class="form-select" required>
                <?php
                    $categorias = $categoriaDAO->ConsultaCat();
                    foreach ($categorias as $categoria):
                        if($it['idcategorias']==$categoria['idcategorias']): ?>
                            <option value='<?=$categoria['idcategorias']?>' selected><?=$categoria['categorias']?></option>
                        <?php else: ?> 
                        <option value='<?=$categoria['idcategorias']?>'><?=$categoria['categorias']?></option>
                    <?php endif; endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="idpreco" class="form-label">Preço</label>
            <input type="text" name="preco" id="idpreco" value="<?=($it['preco'])?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="idmarca" class="form-label">Marca</label>
            <input type="text" name="marca" id="idmarca" value="<?=($it['marca'])?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="idquantidade" class="form-label">Quantidade em estoque</label>
            <input type="number" name="quantidade" id="idquantidade" value="<?=($it['quantidade'])?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="idimagem" class="form-label">Imagem</label>
            <input type="file" name="imagem" id="idimagem" class="form-control">
        </div>
        <div id="imageEdit">
            <img src='data:image/png;base64,<?= base64_encode($it['imagem']) ?>' id='' class='w-100' alt=''>
        </div>
        
        
        <div class="form-check">
        <?php if(($it['promocao'])==1): ?>
            <input type="checkbox" id="idpromocao" name="promocao" onclick="checkedBtn()" class="form-check-input " checked>
            <label for="switch3" class="form-check-label fs-5">Promocao</label>
            <label for="iddesconto" id="desconto" class="form-label desconto">Desconto em %</label>
            <input type="number" min="1" max="100" value='<?=$it['desconto']?>' name="desconto" id="iddesconto" class="form-control mostrar mb-3">
        <?php else: ?>
            <input type="checkbox" id="idpromocao" name="promocao" onclick="checkedBtn()" class="form-check-input">
            <label for="switch3" class="form-check-label fs-5">Promocao</label>
            <label for="iddesconto" id="desconto" class="form-label nmostrar desconto">Desconto em %</label>
            <input type="hidden" min="1" max="100" name="desconto" id="iddesconto" class="form-control mb-3">
        <?php endif; ?>
        
        </div>

       <button type="submit" class="btn btn-primary">Alterar</button>
        
    </form>

    <?php elseif(isset($_GET['tipo']) && $_GET['tipo']=='usuario'): 
        $us = $usuarioDAO->ConsultaID($_GET['p']);?>
    <form method="POST" enctype="multipart/form-data" action="incs/Confirmacao.php?tipo=usuario&acao=editar" class="container w-75 p-4">
        <input type="hidden" name='p' value='<?=$_GET['p']?>'>
        <div class="mb-3">
            <label for="idnome" class="form-label">Nome do usuario</label>
            <input type="text" name="nome" id="idnome" value="<?=$us['nome']?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="idlogin" class="form-label">Login</label>
            <input type="text" name="login" id="idlogin" value="<?=$us['login']?>" class="form-control">
        </div>

        <div class="mb-3">
            <label for="idquantidade" class="form-label">Senha</label>
            <input type="password" name="senha" id="idsenha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="idquantidade" class="form-label">Confirmar Senha</label>
            <input type="password" name="senha2" id="idsenha" class="form-control" required>
        </div>

       <button type="submit" class="btn btn-primary">Alterar</button>
       <?php if(!isset($_GET['msg'])):?>
       <?php elseif (isset($_GET['msg']) && $_GET['msg']==('Usuario Cadastrado'|| 'Produto Alterado' || 'Produto Removido' || 'Usuario Removido' || 'Produto Cadastrado' || '') ):  ?>
        <div class="alert alert-primary my-3" role="alert">
            <?=$_GET['msg']?>
        </div>
       <?php else: ?>
        <div class="alert alert-danger my-3" role="alert">
            <?=$_GET['msg']?>
        </div>
       <?php endif;?>
    </form>
    <?php elseif (isset($_GET['tipo']) && $_GET['tipo']=="cliente") :
        $cl = $clienteDAO->ConsultaID($_GET['p']);
        var_dump($cl);
        ?>
        <form method="POST"  enctype="multipart/form-data" action="incs/Confirmacao.php?tipo=cliente&acao=editar" class="container w-75">
            <h2 class="my-4 text-center">Alterar de Cliente</h2>

            <input type="hidden" name="p" value="<?=$cl['idclientes']?>">

            <input type="hidden"  name="idcartao" value="<?=$cl['idcartao']?>">

            <div class="mb-3">
                <label for="idnome" class="form-label">Nome do Usuario</label>
                <input type="text" name="nome" value="<?=$cl['nome']?>" id="idnome" class="form-control client" >
            </div>

            <div class="mb-3">
                <label for="idpreco" class="form-label">Email</label>
                <input type="Email" name="email" value="<?=$cl['email']?>" id="idlogin" class="form-control client" >
            </div>
            
            <div class="mb-3">
                <label for="idquantidade" class="form-label">CPF</label>
                <input type="number" name="cpf" maxlength="14" value="<?=$cl['cpf']?>" minlength="11" id="idcartao" class="form-control client" >
            </div>

            <div class="mb-3">
                <label for="idmarca" class="form-label">Senha</label>
                <input type="password" name="senha" minlength="4" id="idsenha" class="form-control client">
            </div>

            <div class="mb-3">
                <label for="idquantidade" class="form-label">Confirmar Senha</label>
                <input type="password" name="senha2" minlength="4" id="idsenha2" class="form-control client" >
            </div>

            <div class="mb-3">
                <label for="idquantidade" class="form-label">Nome Cartão</label>
                <input type="text" name="nomecartao" id="idnome" value="<?=$cl['nomecartao']?>" class="form-control client" >
            </div>

            <div class="mb-3">
                <label for="idquantidade" class="form-label">Números do cartão</label>
                <input type="text" name="numeros" maxlength="16" value="<?=$cl['numeros']?>" id="idcartao" class="form-control client" >
            </div>

            <div class="mb-3">
                <label for="idquantidade" class="form-label">3 Números</label>
                <input type="number" name="3numeros" minlength="3" value="<?=$cl['3numeros']?>" maxlength="3" id="idcartao" class="form-control client" >
            </div>
            
            <div class="mb-3">
                <label for="idquantidade" class="form-label">Agência</label>
                <input type="text" name="agencia" id="idcartao" value="<?=$cl['agencia']?>" class="form-control client" >
            </div>

            <div class="mb-3">
                <label for="idquantidade" class="form-label">DATA</label>
                <input type="text" name="data" minlength="4" value="<?=$cl['data']?>" value maxlength="5" id="idcartao" class="form-control client" >
            </div>

            <button type="submit" class="btn btn-primary">Alterar</button>
                    
            </form>
    <?php endif; ?>

<?php
    include "incs/rodapeADM.php";
?>