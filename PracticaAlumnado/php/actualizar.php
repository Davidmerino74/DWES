<?php
require_once 'conexion.php';
$conexion = conexion();

// Recoger datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$fecha = $_POST['fecha_nacimiento'];
$curso = $_POST['curso'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

// Validar duplicado por nombre, apellidos y fecha (excluyendo el actual)
$verificar = "SELECT COUNT(*) AS existe FROM alumnado 
              WHERE Nombre='$nombre' AND Apellidos='$apellidos' AND Fecha_Nacimiento='$fecha' AND id != $id";
$res = mysqli_query($conexion, $verificar);
$fila = mysqli_fetch_assoc($res);

if ($fila['existe'] > 0) {
    echo "<script>
        alert('Ya existe otro alumno con ese nombre, apellidos y fecha de nacimiento');
        window.location.href='listado.php?editar=$id';
    </script>";
    exit;
}

// Validar email duplicado (excluyendo el actual)
$verificar_email = "SELECT id FROM alumnado WHERE Email_Educamos='$email'";
$res_email = mysqli_query($conexion, $verificar_email);
$fila_email = mysqli_fetch_assoc($res_email);

if ($fila_email && $fila_email['id'] != $id) {
    echo "<script>
        alert('Este correo electrónico ya está registrado por otro alumno');
        window.location.href='listado.php?editar=$id';
    </script>";
    exit;
}


// Actualizar el alumno
$sql = "UPDATE alumnado SET 
        Nombre='$nombre', 
        Apellidos='$apellidos', 
        Fecha_Nacimiento='$fecha',
        Curso_Matriculado=$curso, 
        Email_Educamos='$email', 
        Contrasena='$contrasena'
        WHERE id = $id";

if (mysqli_query($conexion, $sql)) {
    echo "<script>
        alert('Alumno actualizado correctamente');
        window.location.href='listado.php';
    </script>";
} else {
    echo "<script>
        alert('Error al actualizar: " . mysqli_error($conexion) . "');
        window.location.href='listado.php?editar=$id';
    </script>";
}

mysqli_close($conexion);
?>
