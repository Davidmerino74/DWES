<html>
<?php
class F3 extends Monoplaza
{
    private $nombreAcademia;

    //constructor
    public function __construct($nombrePiloto, $nacionalidad, $numeroMonoplaza, $escuderia, $nombreAcademia, $puntos = 0)
    {
        parent::__construct($nombrePiloto, $nacionalidad, $numeroMonoplaza, $escuderia, $puntos);
        $this->nombreAcademia = $nombreAcademia;
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
            //en f3 y f4 no hay puntuacion por vuelta rápida
            // if ($vueltaRapida && $posicion <= 10) {
            //     $puntosASumar += 1;
            // }
            $this->puntos += $puntosASumar;
        }
    }

    public function subirCategoria($tieneSuperlicencia)
    {
        //si tiene superlicencia, puede subir a F2
        if ($tieneSuperlicencia) {
            return new F2(
                $this->nombrePiloto,
                $this->nacionalidad,
                $this->numeroMonoplaza,
                $this->escuderia,
                $tieneSuperlicencia, //imagigo que será true, es un booleano y con la condicion del if ya es true sino no pasa dentro del if
                $this->puntos
            );
        }
        return null;
    }
}
?>

</html>