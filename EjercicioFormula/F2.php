<html>
<?php

class F2 extends Monoplaza
{
    private $tieneSuperlicencia;

    //constructor
    public function __construct($nombrePiloto, $nacionalidad, $numeroMonoplaza, $escuderia, $tieneSuperlicencia, $puntos = 0)
    {
        parent::__construct($nombrePiloto, $nacionalidad, $numeroMonoplaza, $escuderia, $puntos);
        $this->tieneSuperlicencia = $tieneSuperlicencia;
    }

    //métodos a implementar de la clase padre
    public function posicionValida($posicion)
    {
        return ($posicion >= 1) && ($posicion <= 24); //si cumple las dos devolvemos true
    }

    public function otorgarPuntos($posicion, $vueltaRapida)
    {
        //ponemos la tabla como llave y valor, la llave es la posicion y el valor la puntuación de la tabla
        $tabla = [
            1 => 10,
            2 => 8,
            3 => 7,
            4 => 6,
            5 => 5,
            6 => 4,
            7 => 3,
            8 => 2,
            9 => 1
        ];

        if ($this->posicionValida($posicion)) {
            //si encontramos el valor en la tabla (dada la posición) nos devuelve el valor que son los puntos a sumar sino es cero.
            $puntosASumar = isset($tabla[$posicion]) ? $tabla[$posicion] : 0;
            if ($vueltaRapida && $posicion <= 10) {
                $puntosASumar += 1;
            }
            $this->puntos += $puntosASumar;
        }
    }

    public function subirCategoria($patrocinador)
    {
        //si tiene patrocinador, puede subir a F1
        return new F1(
            $this->nombrePiloto,
            $this->nacionalidad,
            $this->numeroMonoplaza,
            $this->escuderia,
            $patrocinador,
            $this->puntos
        );
    }
}
?>

</html>