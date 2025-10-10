<html>
<?php
function obtenerPiloto($numero)
{
    $url = "https://api.openf1.org/v1/drivers?driver_number=$numero&session_key=latest";

    //esta función lee el contenido completo de la url y lo devuelve como una cadena de texto
    $json = file_get_contents($url);
    //convertimos la cadena json en una estructura PHP (array o objeto, el segundo parámetro con true le indicamos que queremos un array asociativo en lugar de un objeto, el resultado es un array que podemos recorrer y manipular)
    $datos = json_decode($json, true);

    if (empty($datos)) {
        return "No se encontró información para el piloto número $numero.";
    }

    $piloto = $datos[0]; // Tomamos el primer resultado

    return [
        "Nombre completo" => $piloto["full_name"] ?? "Desconocido",
        "Número" => $piloto["driver_number"] ?? "Sin actualizar",
        "País" => $piloto["country_code"] ?? "Sin actualizar",
        "Equipo" => $piloto["team_name"] ?? "Sin actualizar",
        "Foto" => $piloto["headshot_url"] ?? "No hay Foto para mostrar"
    ];
}

// Mostrar pilotos
$piloto16 = obtenerPiloto(16);
$piloto44 = obtenerPiloto(44);

function mostrarPiloto($datos, $titulo)
{
    echo "<h2>$titulo</h2>";
    if (is_string($datos)) {
        echo $datos;
    } else {
        foreach ($datos as $clave => $valor) {
            if ($clave === "Foto") {
                echo "<img src='$valor' alt='Foto del piloto' width='150'><br>";
            } else {
                echo "<strong>$clave:</strong> $valor<br>";
            }
        }
    }
}

mostrarPiloto($piloto16, "Piloto #16");
mostrarPiloto($piloto44, "Piloto #44");
?>
</html>

