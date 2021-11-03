<?php 

require_once "../../controllers/controller.php";
require_once "../../models/crud.php";


class Ajax {

    public $validarUsuario;

    public function validarUsuarioAjax()
    {
    //asignamos la variable publica en el ambito de la funcion validarusuarioajax
       $datos = $this->validarUsuario;

     //pedimos una repuesta al controlador a traves de la funcion y pasamos datos
       $respuesta = MvcController::validarUsuarioController($datos);

       echo $respuesta;

    }

}


//pasamos el valor de datos y lo mandamos a un objeto
$escuhaAjax = new Ajax();
//obtenemos lo que venga de la variable POST de ajax
$escuhaAjax->validarUsuario = $_POST["validarUsuario"];
//mandamos a ejecutar la funcion con el dato
$escuhaAjax->validarUsuarioAjax();

