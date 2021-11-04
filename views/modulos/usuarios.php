<?php 
 use controllers\controller\MvcController;

session_start();
// validamos que la variable de session no es verdadero
if(!isset($_SESSION["validar"]))
{
  header("location:ingresar");
  exit();
}

if (isset($_GET["action"])) {
  
    if ($_GET["action"] == "cambio") {
      
      echo "<div class='alert alert-success alert-dismissible fade show mt-5' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
              <strong>Bien hecho!</strong> Actualizaste el dato!!.
            </div>";
    }
    else if($_GET["action"] == "borrar"){

        echo "<div class='alert alert-success alert-dismissible fade show mt-5' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
              <strong>Usuario!</strong> Borrado!!.
            </div>";
    }
    else if ($_GET["action"] == "ok") {
    
      echo "<div class='alert alert-success alert-dismissible fade show mt-5' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
              <strong>Bien hecho!</strong> Tu registro fue exitoso!!.
            </div>";
    }
  
  }

?>
<?php if (!empty($_SESSION["usuario"])) {?>
  <div class="container mt-4">
  <ul class="list-group">
    <li class="list-group-item active"> Bienvenido <strong><?php echo $_SESSION["usuario"];?></strong> </li>
  </ul>
  </div>
<?php }?>
<h1 class="mt-5">Lista de usuarios</h1>

<table class="table mt-5">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Email</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
    </thead>
    <tbody>
       
        <?php 
            $listausuarios = new MvcController();
            $listausuarios->vistaUsuariosController(); 
            $listausuarios->borrarUsuariosController();    
        ?>

    </tbody>
</table>



