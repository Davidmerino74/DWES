<?php 
    function conexion(){
        $host="localhost";
        $usuario="root";
        $contrasena="";
        $baseDeDatos="bbdd_practica_alumnado";

        $conexion=mysqli_connect($host,$usuario,$contrasena,$baseDeDatos) or die ("Problemas con la conexión");
    
        return $conexion;
    }
    
?>