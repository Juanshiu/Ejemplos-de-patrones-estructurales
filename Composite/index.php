<?php
// Implementación de la implementación
interface Implementacion {
    public function operacionImplementacion(): string;
}

// Implementación concreta A
class ImplementacionConcretaA implements Implementacion {
    public function operacionImplementacion(): string {
        return "ImplementacionConcretaA";
    }
}

// Implementación concreta B
class ImplementacionConcretaB implements Implementacion {
    public function operacionImplementacion(): string {
        return "ImplementacionConcretaB";
    }
}

// Abstracción
abstract class Abstraccion {
    protected $implementacion;

    public function __construct (Implementacion $implementacion) {
        $this->implementacion = $implementacion;
    }

    abstract public function operacion(): string;
}

// Abstracción refinada
class AbstraccionRefinada extends Abstraccion {
    public function operacion(): string {
        return "AbstraccionRefinada: " . $this->implementacion->operacionImplementacion();
    }
}

// Uso
$implementacionA = new ImplementacionConcretaA();
$abstraccion = new AbstraccionRefinada($implementacionA);
echo $abstraccion->operacion(); // Salida: AbstraccionRefinada: ImplementacionConcretaA
