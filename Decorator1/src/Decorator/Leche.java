package Decorator;

import Cafe.Cafe;

public class Leche extends DecoratorCafe{

    public Leche(Cafe cafe){
        super(cafe);
    }

    @Override
    public void preparar() {
        getCafe().preparar();
        System.out.println("Añandiendo Leche....");
    }
}

