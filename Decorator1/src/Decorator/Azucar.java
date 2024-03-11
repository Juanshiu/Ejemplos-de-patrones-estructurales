package Decorator;

import Cafe.Cafe;

public class Azucar extends DecoratorCafe{

    public Azucar(Cafe cafe){
        super(cafe);
    }

    @Override
    public void preparar() {
        getCafe().preparar();
        System.out.println("Añandiendo Azúcar....");
    }
}

