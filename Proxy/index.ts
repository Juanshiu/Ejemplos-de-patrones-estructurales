/**
 * La interfaz Subject declara operaciones comunes tanto para RealSubject como para el Proxy. Siempre que el cliente trabaje con RealSubject usando esta interfaz, podrás pasarle un proxy en lugar de un sujeto real.
 */
interface Subject {
    request(): void;
}

/**
 * El RealSubject contiene alguna lógica de negocio principal. Usualmente, los RealSubjects son capaces de realizar algún trabajo útil que también puede ser muy lento o sensible, por ejemplo, corrigiendo datos de entrada. Un Proxy puede resolver estos problemas sin ningún cambio en el código del RealSubject.
 */
class RealSubject implements Subject {
    public request(): void {
        console.log('RealSubject: Manejando la solicitud.');
    }
}

/**
 * El Proxy tiene una interfaz idéntica al RealSubject.
 */
class Proxy implements Subject {
    private realSubject: RealSubject;

    /**
     * El Proxy mantiene una referencia a un objeto de la clase RealSubject. Puede ser cargado de manera perezosa o pasado al Proxy por el cliente.
     */
    constructor(realSubject: RealSubject) {
        this.realSubject = realSubject;
    }

    /**
     * Las aplicaciones más comunes del patrón Proxy son la carga diferida, el almacenamiento en caché, el control de acceso, el registro, etc. Un Proxy puede realizar una de estas cosas y luego, dependiendo del resultado, pasar la ejecución al mismo método en un objeto RealSubject vinculado.
     */
    public request(): void {
        if (this.checkAccess()) {
            this.realSubject.request();
            this.logAccess();
        }
    }

    private checkAccess(): boolean {
        // Aquí deberían ir algunas verificaciones reales.
        console.log('Proxy: Verificando el acceso antes de disparar una solicitud real.');

        return true;
    }

    private logAccess(): void {
        console.log('Proxy: Registrando el tiempo de la solicitud.');
    }
}

/**
 * El código del cliente se supone que debe trabajar con todos los objetos (tanto sujetos como proxies) a través de la interfaz Subject para soportar tanto sujetos reales como proxies. Sin embargo, en la vida real, los clientes trabajan principalmente con sus sujetos reales directamente. En este caso, para implementar el patrón de manera más fácil, puedes extender tu proxy desde la clase del sujeto real.
 */
function clientCode(subject: Subject) {
    // ...

    subject.request();

    // ...
}

console.log('Cliente: Ejecutando el código del cliente con un sujeto real:');
const realSubject = new RealSubject();
clientCode(realSubject);

console.log('');

console.log('Cliente: Ejecutando el mismo código del cliente con un proxy:');
const proxy = new Proxy(realSubject, {});
clientCode(proxy);
