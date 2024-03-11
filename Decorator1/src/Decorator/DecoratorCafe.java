package Decorator;

import Cafe.Cafe;

abstract class DecoratorCafe implements Cafe {
    private Cafe cafe;

    public DecoratorCafe(Cafe cafe) {
        this.cafe = cafe;
    }

    protected Cafe getCafe(){
        return cafe;
    }
}
