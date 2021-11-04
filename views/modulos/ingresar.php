<?php 

 use controllers\controller\MvcController;

session_start();
// validamos que la variable de session no es verdadero
if(isset($_SESSION["validar"]))
{
  header("location:usuarios");
  exit();
}



if (isset($_GET["action"])) {
  
  if ($_GET["action"] == "falloIngreso") {
    
    echo "<div class='alert alert-danger alert-dismissible fade show mt-5' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Fallo al ingresar !</strong> usuario inexistente.
          </div>";
  }
  else if(is_numeric($_GET["action"]) && $_GET["action"]  <= 3)
  {
        $tequedan = 3;
          echo "<div class='alert alert-danger alert-dismissible fade show mt-5' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
          <strong>Fallo al ingresar el password!</strong> Te quedan ". $tequedan - $_GET['action']." Intentos  .
        </div>";
  }
  else if($_GET["action"] == "fallo3Intentos") {
          echo "<div class='alert alert-warning alert-dismissible fade show mt-5' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
          <strong>Has fallado tres veces al ingresar el tu password!</strong> Porfavor rellena el captcha .
        </div>";
  }

}

?>
<h1 class="mt-5">Ingresar</h1>

<div class="formulario mt-5" style="margin: 0 auto;">
  <div class="form-group w-50 ">
  <form method="post">
    <div class="form-group">
      <label for="nombreUsuario">Nombre:</label>
      <input type="text" class="form-control" name="usuarioIngreso" id="usuarioIngreso" placeholder="Ingrese su nombre de usuario" required>
    </div>
    <div class="form-group">
      <label for="passwordUsuario">Contraseña: </label>
      <input type="password" class="form-control" name="passwordIngreso" id="passwordIngreso" placeholder="Ingrese su contraseña" required>
    </div>
    <div class="form-group">
      <label for=""></label>
      <input type="submit" class="form-control btn btn-primary btn-lg" value="Acceder">
    </div>
  </form>
  </div>
</div>

<?php 
// mostramos lo que esta registrando
// $ingreso = new MvcController();
MvcController::ingresoUsuarioController();


?>