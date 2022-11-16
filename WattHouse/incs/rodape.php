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

<script type="text/javascript">
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
<!-- Script de abrir Login quando não conectado ná conta -->
<?php if(!isset($_SESSION['idclientes'])):?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#login').modal('show');
    });
</script>
<?php endif; ?>
</body>

</html>