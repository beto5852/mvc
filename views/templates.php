<?php 
    include "modulos/header.php";
    use controllers\controller\MvcController;
 ?>

    <header>
        <h1 class="text-center">LOGOTIPO</h1>
         <?php include "modulos/navegacion.php"; ?>
    </header>


    <div class="container mt-0 mb-0 ml-auto mr-auto">

    <?php 
  
     $mvc = new MvcController();
     $mvc-> enlacesPaginasController();
  
    ?>

    </div>

    <?php include "modulos/footer.php"; ?>
