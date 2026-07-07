<?php
class PronosticoHelper {
    public function calcularGanador($equipoL, $golesL, $equipoV, $golesV) {
        if ($golesL > $golesV) {
            return "Victoria para $equipoL";
        } elseif ($golesV > $golesL) {
            return "Victoria para $equipoV";
        } else {
            return "Empate entre $equipoL y $equipoV";
        }
    }
}
?>