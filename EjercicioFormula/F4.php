<html>
<?php

class F4 extends Monoplaza
{
    private $pais;

    //constructor
    public function __construct($nombrePiloto, $nacionalidad, $numeroMonoplaza, $escuderia, $pais, $puntos = 0)
    {
        parent::__construct($nombrePiloto, $nacionalidad, $numeroMonoplaza, $escuderia, $puntos);
        $this->pais = $pais;
    }

    //métodos a implementar de la clase padre
    public function posicionValida($posicion)
    {
        return ($posicion >= 1) && ($posicion <= 30); //si cumple las dos devolvemos true
    }

    public function otorgarPuntos($posicion, $vueltaRapida)
    {
        //ponemos la tabla como llave y valor, la llave es la posicion y el valor la puntuación de la tabla
        $tabla = [
            1 => 25,
            2 => 18,
            3 => 15,
            4 => 12,
            5 => 10,
            6 => 8,
            7 => 6,
            8 => 4,
            9 => 2,
            10 => 1
        ];

        if ($this->posicionValida($posicion)) {
            //si encontramos el valor en la tabla (dada la posición) nos devuelve el valor que son los puntos a sumar sino es cero.
            $puntosASumar = isset($tabla[$posicion]) ? $tabla[$posicion] : 0;
            //en f3 y f4 no hay puntuacion por vuelta rápida
            // if ($vueltaRapida && $posicion <= 10) {
            //     $puntosASumar += 1;
            // }
            $this->puntos += $puntosASumar;
        }
    }

    public function subirCategoria($nombreAcademia)
    {

        return new F3(
            $this->nombrePiloto,
            $this->nacionalidad,
            $this->numeroMonoplaza,
            $this->escuderia,
            $nombreAcademia,
            $this->puntos
        );
    }
}
?>

</html>