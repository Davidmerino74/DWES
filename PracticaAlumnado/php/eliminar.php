<?php
require_once 'conexion.php';
$conexion = conexion();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM alumnado WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        echo "<script>
            alert('Alumno eliminado correctamente');
            window.location.href = 'listado.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al eliminar: " . mysqli_error($conexion) . "');
            window.location.href = 'listado.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ID inválido');
        window.location.href = 'listado.php';
    </script>";
}

mysqli_close($conexion);
?>

