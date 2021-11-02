<?php 

// Tipo de datos siempre son estrictos
// declare(ticks=1);

class Conexion
{
    

    public static function conectar() {

        try {
            $host = "localhost";
            $usuario = "root";
            $pass = "";
            $db = "cursophp";

            $dsn = 'mysql:host='.$host.';dbname='.$db;
            
            $link = new PDO($dsn,$usuario,$pass);
            // $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $link;

        } catch (PDOException $e){
            $mensaje_error =  $e->getMessage();
            include "views/error/dberror.php";
            exit();
        }       

    }


}
// print_r(PDO::getAvailableDrivers());
// $a = new Conexion();
// $a->conectar();



?>