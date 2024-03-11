<?php
// Componente
interface Componente {
}
public function operacion(): string {
    // Add implementation here
}

// Hoja
class Hoja implements Componente {
    private $nombre;
    
    public function __construct($nombre) {
        $this->nombre = $nombre;
    }
    
    public function operacion(): string {
        return "Hoja: " . $this->nombre;
    }
}

// Composite
class Compuesto implements Componente {
    private $componentes = [];
    
    public function agregar(Componente $componente): void {
        $this->componentes[] = $componente;
    }
    
    public function operacion(): string {
        $resultado = "Compuesto: ";
        
        foreach ($this->componentes as $componente) {
            $resultado .= $componente->operacion();
        }
        
        return $resultado;
    }
}

// Uso
$hoja1 = new Hoja("Hoja 1");
$hoja2 = new Hoja("Hoja 2");
$compuesto = new Compuesto();
$compuesto->agregar($hoja1);
$compuesto->agregar($hoja2);
echo $hoja1->operacion(); // Salida: Hoja: Hoja 1
echo $compuesto->operacion(); // Salida: Compuesto: Hoja: Hoja 1 Hoja: Hoja 2
