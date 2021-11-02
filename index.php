<?php 


#Este index, mostrara la sálidas de las vistas al usuario y también a traves de él enviaremos las distintas acciones que el usuario envie al controlador.

#require() establece que el archivo del codigo invocado es requerido, es decir, obligatorio para el funcionamiento del programa, para ello, si el archivo especificado en la funcion require() no se encuentra, saldra un error "PHP fatal error" y el programa se detendra.

#la version require_once() funciona de la misma manera que su respectivo, salvo que , al utilizar la version _once, se impide la carga de un mismo archivo más de una vez.

#si queremos el mismo código mas de una vez corremos el riesgo de redeclarar variables, funciones y clases.
require_once "controllers/controller.php";

$mvc = new MvcController();
$mvc->plantilla();


?>