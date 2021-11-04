<?php 

namespace views\modulos\ajax;
require_once "../../controllers/controller.php";
use controllers\controller\MvcController;

use models\crud\Datos;
class Ajax {

    public $validarUsuario;

    public static function validarUsuarioAjax( $datos)
    {
    //asignamos la variable publica en el ambito de la funcion validarusuarioajax
      //  $datos = $this->validarUsuario;

     //pedimos una repuesta al controlador a traves de la funcion y pasamos datos
      $respuesta = MvcController::validarUsuarioController($datos);

       echo $respuesta;
      //  echo $datos;

    }

}


//pasamos el valor de datos y lo mandamos a un objeto
// $escuhaAjax = new Ajax();
//obtenemos lo que venga de la variable POST de ajax
$escuhaAjax = $_POST["validarUsuario"];
//mandamos a ejecutar la funcion con el dato
Ajax::validarUsuarioAjax($escuhaAjax);

?>