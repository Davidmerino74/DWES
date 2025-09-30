<?php
require_once 'conexion.php';
$conexion = conexion();

//Recogemos datos del formulario
$Nombre = $_POST['nombre'];
$Apellidos = $_POST['apellidos'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$curso = $_POST['curso'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

//verificamos primero si el alumno ya existe
$verificar = "select count(*) as existe_email from alumnado where Nombre='$Nombre' and Apellidos='$Apellidos' and Fecha_Nacimiento='$fecha_nacimiento'";
$resultado_verificar = mysqli_query($conexion, $verificar) or die("Problemas en el select de verificación" . mysqli_error($conexion));
$fila_verificar = mysqli_fetch_assoc($resultado_verificar);
if ($fila_verificar['existe_email'] > 0) {
    echo "<script>
        alert('Este alumno ya esta registrado');
        window.location.href='../formulario.html';
        </script>";
    exit;
}

//verificamos si el email ya existe
$verificar_email = "select count(*) as existe_email from alumnado where Email_Educamos='$email'";
$resultado_email = mysqli_query($conexion, $verificar_email) or die("Problemas en el select de verificación email" . mysqli_error($conexion));
$fila_email = mysqli_fetch_assoc($resultado_email);
if ($fila_email['existe'] > 0) {
    echo "<script>
        alert('Este Email ya esta registrado');
        window.location.href='../formulario.html';
        </script>";
    exit;
}


//Comprobar si hay menos de 25 alumnos en ese curso
$consulta = "select count(*) as total from alumnado where Curso_matriculado=$curso";
$resultado = mysqli_query($conexion, $consulta) or die("Problemas en el select:" . mysqli_error($conexion));
$fila = mysqli_fetch_assoc($resultado);

//La función mysqli_fetch_assoc() convierte esa única fila en un array asociativo, es decir, un array donde las claves son los nombres de las columnas.Como usaste AS total, el nombre de la columna será "total" y $fila un array con una sola clave 'total' y su valor correspondiente que en este caso es el número de alumnos
if ($fila['total'] >= 25) {
    echo "<script> 
        alert('No se pueden matricular más alumnos en $cursoº ESO'
        window.location.href=../formulario.html';
        </script>";
} else {
    //Insertamos al alumno
    $sql = "insert into alumnado (Nombre,Apellidos,Fecha_Nacimiento,Curso_Matriculado,Email_Educamos,Contrasena) values ('$Nombre','$Apellidos','$fecha_nacimiento',$curso,'$email','$contrasena')";

    if (mysqli_query($conexion, $sql)) {
        //con esta instruccion solo lo muestra no redirige al html  echo "Alumno registrado correctamente";
        echo "<script>
            alert('Alumno registrado correctamente');
            window.location.href='../formulario.html';
            </script>";
    } else {
        echo "<script>
            alert('Error al registrar al alumno: " . mysqli_error($conexion) . "');
            window.location.href='../formulario.html';
            </script>";
    }
}
mysqli_close($conexion);
