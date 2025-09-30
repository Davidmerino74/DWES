<?php 
require_once 'conexion.php';
$conexion = conexion();

$consulta = "SELECT * FROM alumnado ORDER BY Apellidos ASC, Curso_Matriculado ASC";
$resultado = mysqli_query($conexion, $consulta) or die("Problemas en el select: " . mysqli_error($conexion));

echo "<h3>Listado de alumnado registrado</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Fecha de Nacimiento</th>
        <th>Curso</th>
        <th>Email</th>
        <th>Contraseña</th>
        <th>Acciones</th>
    </tr>";

while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    //al dar a editar en la url le pasamos el dato listado.php?editar=5 por ejemplo si es la 5 la pulsada, no lo veo porque esta dentro del iframe y se recarga en la misma pagina html que ya esta, pero el dato lo pasa y vamos conprobando en el bucle si la fila es la pulsada lo ponemos en modo edicion y si no coincide lo dejamos como tabla normal.(se puede comprobar renombrando el fichero a formulario.php y usar include 'php/listado.php' en lugar del iframe, asi el contenido cambia directamente y vemos los cambios en la url)
    if (isset($_GET['editar']) && $_GET['editar'] == $fila['id']) {
        // Modo edición
        echo "<form action='actualizar.php' method='post'>";
        echo "<input type='hidden' name='id' value='{$fila['id']}'>";
        echo "<td><input type='text' name='nombre' value='{$fila['Nombre']}' required></td>";
        echo "<td><input type='text' name='apellidos' value='{$fila['Apellidos']}' required></td>";
        echo "<td><input type='date' name='fecha_nacimiento' value='{$fila['Fecha_Nacimiento']}' required></td>";
        echo "<td>
                <select name='curso'>";
        for ($i = 1; $i <= 4; $i++) {
            $selected = ($fila['Curso_Matriculado'] == $i) ? "selected" : "";
            #OJO CON iº no sale el º, buscando info la equivalencia es ordm que es ordinal masculino, asi si se ve bien el selector.
            echo "<option value='$i' $selected>$i&ordm ESO</option>";
        }
        echo "</select></td>";
        echo "<td><input type='email' name='email' value='{$fila['Email_Educamos']}' required></td>";
        echo "<td><input type='text' name='contrasena' value='{$fila['Contrasena']}' required></td>";
        echo "<td>
                <input type='submit' value='Guardar'>
                <a href='listado.php'><button type='button'>Cancelar</button></a>
            </td>";
        echo "</form>";
    } else {
        // Modo lectura, LOS ICONOS CON COGIDOS DE INTERNET Y EL RETURN CONFIRM DEL ONCLICK TAMBIÉN
        echo "<td>{$fila['Nombre']}</td>";
        echo "<td>{$fila['Apellidos']}</td>";
        echo "<td>{$fila['Fecha_Nacimiento']}</td>";
        echo "<td>{$fila['Curso_Matriculado']}º ESO</td>";
        echo "<td>{$fila['Email_Educamos']}</td>";
        echo "<td>{$fila['Contrasena']}</td>";
        echo "<td>
                <a href='listado.php?editar={$fila['id']}'>✏️ Editar</a> |
                <a href='eliminar.php?id={$fila['id']}' onclick='return confirm(\"¿Seguro que quieres eliminar a {$fila['Nombre']} {$fila['Apellidos']}?\")'>🗑️ Borrar</a>
            </td>";
    }

    echo "</tr>";
}

echo "</table>";
mysqli_close($conexion);
?>
