<?php 


#Este index, mostrara la sálidas de las vistas al usuario y también a traves de él enviaremos las distintas acciones que el usuario envie al controlador.

#require() establece que el archivo del codigo invocado es requerido, es decir, obligatorio para el funcionamiento del programa, para ello, si el archivo especificado en la funcion require() no se encuentra, saldra un error "PHP fatal error" y el programa se detendra.

#la version require_once() funciona de la misma manera que su respectivo, salvo que , al utilizar la version _once, se impide la carga de un mismo archivo más de una vez.

#si queremos el mismo código mas de una vez corremos el riesgo de redeclarar variables, funciones y clases.
require_once "controllers/controller.php";

MvcController::plantilla();

#si un fichero contienen código PHP puro, es preferible omitir la etiqueta de cierre de PHP al final del fichero, esto impide que se añada espacios blancos o nuevas líneas despúes de la etiqueta de cierre en PHP, los cuales pueden causar efectos no deseados debido a que PHP iniciará la salida del buffer cuando no había intención en por parte del programador de enviar nínguna salida de ese punto del script