package Cafe;

public class CafeSimple implements Cafe {

    private String nombre;

    public CafeSimple(String s){
        nombre = s;
    }

    @Override
    public void preparar() {
        System.out.println("Preparando Cafe....");
    }
}
