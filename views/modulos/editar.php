<?php 

session_start();
// validamos que la variable de session no es verdadero
if(!isset($_SESSION["validar"]))
{
  header("location:ingresar");
}


?>
<h1 class="mt-5 ">Editar usuario</h1>


<div class="formulario mt-5" style="margin: 0 auto;">
  <div class="form-group w-50 ">

  <form method="post">
    
      <?php 

      $editar = new MvcController();
      $editar->editarUsuarioController();
      $editar->actualizarUsuariosController();

      ?>
  </form>
  </div>
</div>

