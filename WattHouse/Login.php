<?php
    require_once "src/UsuarioDAO.php";
    $usuarioDAO = new UsuarioDAO();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Watthouse Admin</title>

    <!-- Bootstrap CSS CDN -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/estilo_menu.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
    <h2 class="my-4 text-center">Login - ADM</h2>
        <form method="POST" enctype="multipart/form-data" action="incs/LoginConfirm.php" class="container border border-3 rounded w-75 p-4">

        <div class="mb-3">
            <label for="idpreco" class="form-label">Login</label>
            <input type="text" name="login" id="idlogin" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="idmarca" class="form-label">Senha</label>
            <input type="password" name="senha" id="idsenha" class="form-control">
        </div>

       <button type="submit" class="btn btn-primary mb-2">Login</button>

       <?php if(!isset($_GET['msg'])):?>
       <?php elseif (isset($_GET['msg'])):  ?>
            <div class="alert alert-danger m-0" role="alert"><?=$_GET['msg']?></div>
        <?php endif; ?>

        </form>
    </div>
</body>
</html>