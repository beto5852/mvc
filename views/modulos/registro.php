<?php 

if (isset($_GET["action"])) {
  
  if($_GET["action"] == "falloRegistro"){

    echo '<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>     
          <strong>Fallo al registrar !</strong> el usuario.
          <br>
        </div>';
  } 

}

?>

<h1 class="mt-5">Registro de usuarios</h1>

<div class="formulario mt-5" style="margin: 0 auto;">
  <div class="form-group w-50 ">
  <form method="post">
    <div class="form-group">
      <label for="usuarioRegistro">Nombre:</label>
      <input type="text" class="form-control" name="usuarioRegistro" id="usuarioRegistro" placeholder="Ingrese su nombre de usuario" required>
    </div>
    <div class="form-group">
      <label for="passwordRegistro">Contraseña: </label>
      <input type="password" class="form-control" name="passwordRegistro" id="passwordRegistro" placeholder="Ingrese su contraseña" autocomplete="off" required>
    </div>
    <div class="form-group">
      <label for="emailRegistro">Email: </label>
      <input type="email" class="form-control" name="emailRegistro" id="emailRegistro" placeholder="Ingrese un correo" required>
    </div>
    <div class="form-group">
      <label for=""></label>
      <input type="submit" class="form-control btn btn-success btn-lg" id="registrar">
    </div>
  </form>
  </div>
</div>


<?php 
// mostramos lo que esta registrando
MvcController::registroUsuarioController();


?>

<script src="views/js/validarRegistro.js"></script>

