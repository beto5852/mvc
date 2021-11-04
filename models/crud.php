<?php 

#EXTENSION DE LA CLASE: Los obajetos pueden ser extendidos y pueden heredar propiedades y metodos, para definir una clase como extención, se debe definir una clase padre, y se utiliza dentro de una clase hija

namespace models\crud;
include_once "models/conexion.php";

use models\conexion\Conexion;
use \PDO;
use \PDOException;

class Datos extends Conexion
{
    #---------------------------------------------------------
    # REGISTRO DE USUARIOS
    #---------------------------------------------------------
    public static function registroUsuarioModel($datosModel, $tabla)
    {
        #prepare(), Prepara una sentencia sql para ser ejecutada por método PDOStatement::execute la sentencia SQL puede contener cero o mas marcadores de parametros con nombre (:name) o signos de interrogacion (?) por los cuales los valores reales seran sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros

        $cadena = Conexion::conectar()->prepare( "INSERT INTO $tabla( usuario, password, email) VALUES (:usuario, :password,:email)");

        #El Operador de Resolución de Ámbito :: (también denominado Paamayim Nekudotayim) o en términos simples, el doble dos-puntos, es un token que permite acceder a elementos estáticos, constantes, y sobrescribir propiedades o métodos de una clase. Cuando se hace referencia a estos items desde el exterior de la definición de la clase, se utiliza el nombre de la clase.


        

        #binParam(), vincula una variable php  a un parametro de sustitucion con nombre o signo de interrogación correspondiente de la sentencia sql que fue usada para perpara sentencia
        $cadena->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $cadena->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
        $cadena->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

        if($cadena->execute()) {

           return "exitoso";
        }
        else {
            return "error";
        }

        $cadena = null;
    }


    #---------------------------------------------------------
    # INGRESO DE USUARIOS
    #---------------------------------------------------------
    public static function ingresoUsuarioModel($datosModel, $tabla)
    {
        
        $cadena = Conexion::conectar()->prepare( "SELECT usuario, password, email, intentos FROM $tabla WHERE usuario = :usuario ");

        $cadena->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $cadena->execute();

        return $cadena->fetch();


        //cerramos las conexiones
        $cadena = null;
    }

    #---------------------------------------------------------
    # INTENTOS DE USUARIOS
    #---------------------------------------------------------
    public static function intentosUsuarioModel($datosModel, $tabla)
    {
        $cadena = Conexion::conectar()->prepare( "UPDATE $tabla SET intentos = :intentos WHERE usuario = :usuario");
        $cadena->bindParam(":intentos", $datosModel["actualizarIntentos"], PDO::PARAM_INT);
        $cadena->bindParam(":usuario", $datosModel["usuarioActual"], PDO::PARAM_STR);


        if($cadena->execute()) {

            return "agregado";
         }
         else {
             return "error";
         }
        

        //cerramos las conexiones
        $cadena = null;
    }

      #---------------------------------------------------------
    # INGRESO DE USUARIOS
    #---------------------------------------------------------
    public static function vistaUsuariosModel($tabla)
    {
       
        $cadena = Conexion::conectar()->prepare( "SELECT id_usuario, usuario, password, email FROM $tabla");
        $cadena->execute();

        #fetchAll(); obtiene todas las filas de un conjunto de resultados asociados al PDOStatement
        return $cadena->fetchAll();

        //cerramos las conexiones
        $cadena = null;
    }

      #---------------------------------------------------------
    # EDITAR USUARIOS
    #---------------------------------------------------------
    public static function editarUsuarioModel($datosModel, $tabla)
    {
       
        $cadena = Conexion::conectar()->prepare( "SELECT id_usuario, usuario, password, email FROM $tabla WHERE id_usuario  = :id");

        $cadena->bindParam(":id", $datosModel, PDO::PARAM_INT);
        $cadena->execute();

        #fetch(); obtiene solo la fila del asociados al PDOStatement
        return $cadena->fetch();

        //cerramos las conexiones
        $cadena = null;
    }


      #---------------------------------------------------------
    # ACTUALIZAR USUARIOS
    #---------------------------------------------------------
    public static function actualizarUsuarioModel($datosModel, $tabla)
    {
       
        $cadena = Conexion::conectar()->prepare( "UPDATE $tabla SET usuario = :usuario, password = :password, email = :email  WHERE id_usuario = :id");

        $cadena->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $cadena->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
        $cadena->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
        $cadena->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

        if($cadena->execute()) {

            return "exitoso";
         }
         else {
             return "error";
         }

        //cerramos las conexiones
        $cadena = null;
    }


    #---------------------------------------------------------
    # BORRAR USUARIOS
    #---------------------------------------------------------
    public static function borrarUsuarioModel($datosModel, $tabla)
    {

        try {
            $cadena = Conexion::conectar()->prepare( "DELETE FROM $tabla WHERE id_usuario = :id");
            $cadena->bindParam(":id", $datosModel, PDO::PARAM_INT);
    
            if($cadena->execute()) {
    
                return "exitoso";
             }
             else {
                 return "error";
             }

        } catch(PDOException $e) {
            echo '<p class="bg-danger">'.$e->getMessage().'</p>';
        }
       
        //cerramos las conexiones
        $cadena = null;
    }

    #---------------------------------------------------------
    # VALIDAR USUARIOS EXISTENTE
    #---------------------------------------------------------
    public static function validarUsuarioModel($datosModel, $tabla)
    {

        $cadena = Conexion::conectar()->prepare( "SELECT usuario FROM $tabla WHERE usuario  = :usuario");
        $cadena->bindParam(":usuario", $datosModel, PDO::PARAM_STR);
        $cadena->execute();

        #fetch(); obtiene solo la fila del asociados al PDOStatement
        return $cadena->fetch();

   
       
        //cerramos las conexiones
        $cadena = null;
    }




    

}





?>