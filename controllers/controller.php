<?php 

//Definir namespace
namespace controllers\controller;
require_once "./models/model.php";
require_once "./models/crud.php";
use models\model\EnlacesPaginas;
use models\crud\Datos;


class MvcController
{
    #-------------------------------------------------------------
    #Metodo para invocar a la plantilla
    #-------------------------------------------------------------

    public function plantilla()
    {
        // usamos include para invocar el archivo que contienen el codigo html
        include "views/templates.php";
    }
   
    #-------------------------------------------------------------
    #INTERACCION DEL USUARIO
    #-------------------------------------------------------------

    public static function enlacesPaginasController()
    {

        //validar que la variable tenga informacion

        // $enlacesController = isset($_GET["action"]) ?? 'registro';

        if(isset( $_GET["action"])) {
            //obtenemos el valor
            $enlacesController = $_GET["action"];

        }
        else{
            // si no tenemos un action por default le agregamos el index
            $enlacesController = "index";

        }
        // echo $enlacesController;

        $repuesta = EnlacesPaginas::enlacesPaginasModel($enlacesController);

        // incluimos el path obtenida desde el modelo
        include $repuesta;

    }

     #-------------------------------------------------------------
    #REGISTRO DE USUARIOS
    #-------------------------------------------------------------

    public static function registroUsuarioController()
    {
        
        if (isset($_POST["usuarioRegistro"])) {

            #preg_match  realiza una comparacion con una expresion regular

            if(preg_match('/^[a-zA-Z0-9]+$/' ,$_POST["usuarioRegistro"]) && preg_match('/^[a-zA-Z0-9]+$/',$_POST["passwordRegistro"]) && filter_var($_POST["emailRegistro"], FILTER_VALIDATE_EMAIL))
            {

                //creamos una variable encriptar
                //crypt() devolverá el hash de un string utilizando el algoritmo estándar.

                // $blowfish_salt = "$2y$10$".bin2hex(openssl_random_pseudo_bytes(11)); 

                $blowfish_salt = '$2a$07$usesomesillystringforsalt$';

                // $encriptar = password_hash($_POST["passwordRegistro"], PASSWORD_DEFAULT, ['cost' => 11]); 

                $encriptar = crypt($_POST["passwordRegistro"], $blowfish_salt); 

                $datosController = array("usuario" => $_POST["usuarioRegistro"],
                        "password" => $encriptar,
                        "email" => $_POST["emailRegistro"]);
        
                $repuesta = Datos::registroUsuarioModel($datosController, "usuarios");
        
                //validar registro exitoso
                    if ($repuesta == "exitoso") {

                    // redirigimos a una pagina que diga ok
                    // para actualizar la pagina
                    //quitamos el index.php?action=ok y usamos el htaccess como url amigables
                    header("location:ok");
                    exit();
                    }
                    else {
                            header("location:index.php");
                    }
                
            }else{
                header("location:falloUserName");
            }          
        }
    }

    #---------------------------------------------------------
    # INGRESO DE USUARIOS
    #---------------------------------------------------------

    public static function ingresoUsuarioController()
    {
        if (isset($_POST["usuarioIngreso"])) 
        {

            if(preg_match('/^[a-zA-Z0-9]+$/' ,$_POST["usuarioIngreso"]) && preg_match('/^[a-zA-Z0-9]+$/',$_POST["passwordIngreso"]))
            {

                $blowfish_salt = '$2a$07$usesomesillystringforsalt$';
                 
                $encriptar = crypt($_POST["passwordIngreso"], $blowfish_salt); 
            
                $datosController = array("usuario" => $_POST["usuarioIngreso"],"password" => $encriptar);

                $respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
              
                if ($respuesta == TRUE) {
                    //obtener los intentos y el usuario
                    $intentos = $respuesta["intentos"];
                    $usuario = $_POST["usuarioIngreso"];
                    $maxIntentos = 3;

                    //evaluar a la cantidad maxima de intentos no supere el maximo
                    if ($intentos < $maxIntentos) 
                    {
                        // si el usaurio existe en la BD como coincidencia               

                        if ($respuesta["usuario"] == $_POST["usuarioIngreso"] &&
                            $respuesta["password"] == $encriptar)
                        {
                            
                            $_SESSION["validar"] = TRUE;
                            // $_SESSION["usuario"] = $respuesta["usuario"];
                            // $_SESSION["email"] = $respuesta["email"];

                            $intentos = 0;

                            $datosIntentos = array("usuarioActual" => $usuario, "actualizarIntentos" => $intentos);

                            $repuestaActualizarIntentos = Datos::intentosUsuarioModel($datosIntentos,"usuarios");

                                //redirecciona a la lista de usuarios
                                header("location:usuarios");
                        }                        
                        else {
                                //incrementamos los intentos
                                ++$intentos;
                                //asigamos los datos a una variable para enviarla a la BD
                                $datosIntentos = array("usuarioActual" => $usuario,
                                                        "actualizarIntentos" => $intentos);

                                $repuestaActualizarIntentos = Datos::intentosUsuarioModel($datosIntentos,"usuarios");

                                //validar agregar el intento
                                if ($repuestaActualizarIntentos == "agregado") {
                    
                                // redirigimos al la página con el numero de intentos
                                    header("location:$intentos");
                                }
                                else {
                                        header("location:index.php");
                                }

                        } 
                        
                    }
                    else {
                        /** inicializamos el contador de intentos  */
                        $intentos = 0;

                        $datosIntentos = array("usuarioActual" => $usuario,
                        "actualizarIntentos" => $intentos);
                        
                        /** mandar los intentos actualizados */
                        $repuestaActualizarIntentos = Datos::intentosUsuarioModel($datosIntentos,"usuarios");

                        //validar agregar si el intento fue actualizado correctamente
                        if ($repuestaActualizarIntentos == "agregado") {

                        // redirigimos a una pagina de fallo 3 intentos
                        header("location:fallo3Intentos");
                        }
                        else {
                            header("location:index.php");
                        }

                    }
                }

                
            } 
        }
    }

      #-------------------------------------------------------------
    #LISTAR USUARIOS DEL USUARIO
    #-------------------------------------------------------------
    public static function vistaUsuariosController()
    {
        $respuesta = Datos::vistaUsuariosModel("usuarios");

        // recorremos el arreglo obtenido a traves de la consulta en la BD con el item
        foreach ($respuesta as $row => $item) {
            
            //en el boton de eliminar linkeamos con una peticion get para eliminar a tarves de un action y un id seleccionado

            echo '<tr>
                    <td scope="row">'.$item["usuario"].'</td>
                    <td>'.$item["password"].'</td>
                    <td>'.$item["email"].'</td>
                    <td><a href="index.php?action=editar&id='.$item["id_usuario"].'"><button class="btn btn-primary">Editar</button></a></td>
                    <td><a href="index.php?action=usuarios&idBorrar='.$item["id_usuario"].'"><button class="btn btn-danger">Borrrar</button></a></td>
                </tr>';
        }
       

    }

      #-------------------------------------------------------------
    #EDITAR USUARIOS DEL USUARIO
    #-------------------------------------------------------------
    public static function editarUsuarioController()
    {
        // recibimos el id a traves de un get
        $datosController = $_GET["id"];

        $respuesta = Datos::editarUsuarioModel($datosController,"usuarios");

        // mandamos el id oculto para poder editar, ademas del usuario, password, email

        echo ' <input type="hidden" value="'.$respuesta["id_usuario"].'" name="idEditar">
                <div class="form-group">
                    <label for="nombreUsuario">Nombre:</label>
                    <input type="text" class="form-control" name="usuarioEditar" value="'.$respuesta["usuario"].'" required>
                </div>
                <div class="form-group">
                    <label for="passwordUsuario">Contraseña: </label>
                    <input type="text " class="form-control" name="passwordEditar" value="'.$respuesta["password"].'" required>
                </div>
                <div class="form-group">
                    <label for="passwordUsuario">Email: </label>
                    <input type="email" class="form-control" name="emailEditar" value="'.$respuesta["email"].'" required>
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <input type="submit" class="form-control btn btn-warning btn-lg" value="Actualizar Datos">
                </div>';
    }

      #-------------------------------------------------------------
    #ACTUALIZAR USUARIOS 
    #-------------------------------------------------------------
    public static function actualizarUsuariosController()
    {
        // recibimos por el metodo POST el name=usuarioEditar para ver si no esta vacia
        if (isset($_POST["usuarioEditar"])) {

            //preg_match — Realiza una comparación con una expresión regular

            if (preg_match('/^[a-zA-Z0-9]+$/' ,$_POST["usuarioEditar"]) &&
            preg_match('/^[a-zA-Z0-9]+$/',$_POST["passwordEditar"]) &&
            preg_match('/^[0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9]+)*[.][a-zA-Z]{2,4}$/',$_POST["emailEditar"])) {

                $blowfish_salt = '$2a$07$usesomesillystringforsalt$';


                $encriptar = crypt($_POST["passwordEditar"], $blowfish_salt); 

                $datosController = array("id" => $_POST["idEditar"],
                "usuario" => $_POST["usuarioEditar"],
                "password" => $encriptar,
                "email" => $_POST["emailEditar"]);

                    $respuesta = Datos::actualizarUsuarioModel($datosController,"usuarios");

                    if ($respuesta == "exitoso") {
                        # code...
                        header("location:cambio");
                        exit();
                    }
                    else {

                        echo "<div class='alert alert-danger alert-dismissible fade show mt-5' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                        <strong>Algo salio mal!</strong> No se completo la operación!!.
                        </div>";
                    }
            }
            

        }
    }


     #-------------------------------------------------------------
    #BORRRAR USUARIOS 
    #-------------------------------------------------------------
    public static function borrarUsuariosController()
    {
        
        if (isset($_GET["idBorrar"])) {
            
            // recibimos el id a traves de un get
            $datosController = $_GET["idBorrar"];

            $respuesta = Datos::borrarUsuarioModel($datosController,"usuarios");

            if ($respuesta == "exitoso") {
                # redirigimos a la lista de usuarios
                header("location:borrar");
            }
            else {
                # imprimimos un error
                echo "<div class='alert alert-danger alert-dismissible fade show mt-5' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <strong>Algo salio mal!</strong> No se completo la operación!!.
                </div>";
            }
        }
    }

     #-------------------------------------------------------------
    #VALIDAR DEL USUARIO
    #-------------------------------------------------------------
    public static function validarUsuarioController($validarUsuario)
    {
        $datosController = $validarUsuario;

        $respuesta= Datos::validarUsuarioModel($datosController, "usuarios");

        if (count($respuesta["usuario"]) > 0) {
            
            echo 0;
        }
        else{
            echo 1;
        }
    }

}


