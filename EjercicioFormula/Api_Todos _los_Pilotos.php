<html>
<?php
    //cogido todos los pilotos de la ultima sesion, solo pilotos unicos para que no salgan repetidos
    $url = "https://api.openf1.org/v1/drivers?session_key=latest";
    $json = file_get_contents($url);
    $datos = json_decode($json, true);

    $pilotosUnicos = [];

    foreach ($datos as $piloto) {
        $numero = $piloto["driver_number"];
        if (!isset($pilotosUnicos[$numero])) {
            $pilotosUnicos[$numero] = [
                "Nombre" => $piloto["full_name"] ?? "Desconocido",
                "Número" => $numero,
                "País" => $piloto["country_code"] ?? "N/A",
                "Equipo" => $piloto["team_name"] ?? "N/A",
                "Foto" => $piloto["headshot_url"] ?? ""
            ];
        }
    }

    // Mostrar todos los pilotos únicos
    foreach ($pilotosUnicos as $piloto) {
        echo "<h3>Piloto #{$piloto['Número']}</h3>";
        echo "<strong>Nombre:</strong> {$piloto['Nombre']}<br>";
        echo "<strong>País:</strong> {$piloto['País']}<br>";
        echo "<strong>Equipo:</strong> {$piloto['Equipo']}<br>";
        echo "<img src='{$piloto['Foto']}' width='120'><br><br>";
    }

?>
</html>