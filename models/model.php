<?php 

// Tipo de datos siempre son estrictos
// declare(strict_types=1);

class EnlacesPaginas
{
    public static function enlacesPaginasModel($enlacesModel)
    {
        
        #validamos el enlace

        if($enlacesModel == "nosotros" ||
            $enlacesModel == "servicios" ||
            $enlacesModel == "contactenos" ||
            $enlacesModel == "ingresar" ||
            $enlacesModel == "usuarios" ||
            $enlacesModel == "editar" ||
            $enlacesModel == "salir") {
            
            $module = "views/modulos/".$enlacesModel.".php";
        }
        else if($enlacesModel == "index") {

            $module = "views/modulos/registro.php";

        }
        else if($enlacesModel == "ok") {

            $module = "views/modulos/usuarios.php";

        }
        else if($enlacesModel == "falloRegistro") {

            $module = "views/modulos/registro.php";

        }
        else if($enlacesModel == "falloIngreso") {

            $module = "views/modulos/ingresar.php";

        }
        else if($enlacesModel <= 3) {

            $module = "views/modulos/ingresar.php";

        }
        else if($enlacesModel == "fallo3Intentos") {

            $module = "views/modulos/ingresar.php";

        }
        else if($enlacesModel == "cambio") {

            $module = "views/modulos/usuarios.php";

        }
        else if($enlacesModel == "borrar") {

            $module = "views/modulos/usuarios.php";

        }
        else {
            
            $module = "views/modulos/registro.php";
        }

        return $module;
    }
}


