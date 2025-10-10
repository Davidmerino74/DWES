<html>
<?php
class F3 extends Monoplaza
{
    private $potenciaMaxima;

    //constructor
    public function __construct($nombrePiloto, $nacionalidad, $numeroMonoplaza, $escuderia, $potenciaMaxima, $puntos = 0)
    {
        parent::__construct($nombrePiloto, $nacionalidad, $numeroMonoplaza, $escuderia, $puntos);
        $this->nombreAcademia = $potenciaMaxima;
    }

    //métodos a implementar de la clase padre
    public function posicionValida($posicion)
    {
        return ($posicion >= 1) && ($posicion <= 18); //si cumple las dos devolvemos true
    }

    public function otorgarPuntos($posicion, $vueltaRapida)
    {
        //ponemos la tabla como llave y valor, la llave es la posicion y el valor la puntuación de la tabla
        $tabla = [
            1 => 18,
            2 => 15,
            3 => 12,
            4 => 10,
            5 => 8,
            6 => 6,
            7 => 4,
            8 => 2,
            9 => 1
        ];

        if ($this->posicionValida($posicion)) {
            //si encontramos el valor en la tabla (dada la posición) nos devuelve el valor que son los puntos a sumar sino es cero.
            $puntosASumar = isset($tabla[$posicion]) ? $tabla[$posicion] : 0;
            //en f3 y f4 no hay puntuacion por vuelta rápida y e FAcademy tampoco
            // if ($vueltaRapida && $posicion <= 10) {
            //     $puntosASumar += 1;
            // }
            $this->puntos += $puntosASumar;
        }
    }

    public function subirCategoria($pais)
    {
        //si tiene pais, puede subir a F4

        return new F4(
            $this->nombrePiloto,
            $this->nacionalidad,
            $this->numeroMonoplaza,
            $this->escuderia,
            $pais,
            $this->puntos
        );
    }
}
?>

</html>