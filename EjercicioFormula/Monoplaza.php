<html>
<?php

abstract class Monoplaza
{
    protected $nombrePiloto;
    protected $nacionalidad;
    protected $numeroMonoplaza;
    protected $escuderia;
    protected $puntos;

    public function __construct($nombrePiloto, $nacionalidad, $numeroMonoplaza, $escuderia, $puntos)
    {
        $this->nombrePiloto = $nombrePiloto;
        $this->nacionalidad = $nacionalidad;
        $this->numeroMonoplaza = $numeroMonoplaza;
        $this->escuderia = $escuderia;
        $this->puntos = $puntos;
    }

    //solo pongo de puntos por que es lo que vamos incrementando, el resto de propiedades son fijas
    public function getPuntos()
    {
        return $this->puntos;
    }
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;
    }

    //Métodos a resolver por las clases hijas PREGUNTAR SI HACE FALTA INDICAR string, int, boolean
    abstract function otorgarPuntos($posicion, $vueltaRapida);

    abstract function posicionValida($posicion);

    // quitado este método abstract function subirCategoria(); ya que no todos tienen este método, ni reciben los mismos parámetros, por ejemplo de la f2 a la f1 habría que pasarle $patrocinador, otra que en la f1 no hay subir categoria por que ya esta en la categoria superior.Al dejarlo sin parámetro aquí e incluirlo en f2 con el parametro $patrocinador ya que es necesario para crear una instancia de f1 ya que f2 no tiene esa propiedad, da error. otra seria dejarlo y ponerle los parámetro necesarios por defecto al crear la instancia nueva si le hace falta alguna propiedad de la categoria superior y así no haría falta pasarle ningun parámetro, pero el enunciado indica que si hay que pasarle parámetro.
}
?>
</html>