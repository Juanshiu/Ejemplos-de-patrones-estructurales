import Cafe.Cafe;
import Cafe.CafeSimple;
import Decorator.Azucar;
import Decorator.Leche;


public class Main {
    public static void main(String[] args) {
        Cafe cafe1 = new Leche(new Azucar(new CafeSimple("Cappucino")));
        cafe1.preparar();
    }
}