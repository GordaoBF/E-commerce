</main>
<!-- rodapé -->
<footer class="container-fluid m-0 p-0 footer">
    <!-- direitos -->
    <p class="fs-6 text-center pt-4 pb-2 text-light">Todos os direitos reservados &copy;</p>
    <hr class="container p-0 text-light">
    <!-- links -->
    <div class="container d-flex justify-content-center">
        <a href="#header"><img src="img/WATTHOUSE_White.png" width="300px"></a>
    </div>
    
</footer>

<!-- Scripts e outras coisas -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- jquery -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
                        
<!-- Script de abrir Login -->
<script type="text/javascript">
if(<?php if(isset($_GET['v']))?>==true){
    $('#login').modal('show');
}
</script>

</body>

</html>