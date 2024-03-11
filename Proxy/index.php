<?php

namespace RefactoringGuru\Proxy\RealWorld;

/**
 * La interfaz Subject describe la interfaz de un objeto real.
 *
 * La verdad es que muchas aplicaciones reales pueden no tener esta interfaz claramente definida.
 * Si te encuentras en esa situación, tu mejor opción sería extender el Proxy de una de tus clases de aplicación existentes. Si eso es incómodo, entonces extraer una interfaz adecuada debería ser tu primer paso.
 */
interface Downloader
{
    public function download(string $url): string;
}

/**
 * El Real Subject hace el trabajo real, aunque no de la manera más eficiente.
 * Cuando un cliente intenta descargar el mismo archivo por segunda vez, nuestro descargador simplemente lo hace, en lugar de obtener el resultado de la caché.
 */
class SimpleDownloader implements Downloader
{
    public function download(string $url): string
    {
        echo "Descargando un archivo de Internet.\n";
        $result = file_get_contents($url);
        echo "Bytes descargados: " . strlen($result) . "\n";

        return $result;
    }
}

/**
 * La clase Proxy es nuestro intento de hacer la descarga más eficiente. Envuelve el objeto descargador real y delega las primeras llamadas de descarga. El resultado se almacena en caché, haciendo que las llamadas posteriores devuelvan un archivo existente en lugar de descargarlo nuevamente.
 *
 * Nota que el Proxy DEBE implementar la misma interfaz que el Real Subject.
 */
class CachingDownloader implements Downloader
{
    /**
     * @var SimpleDownloader
     */
    private $downloader;

    /**
     * @var string[]
     */
    private $cache = [];

    public function __construct(SimpleDownloader $downloader)
    {
        $this->downloader = $downloader;
    }

    public function download(string $url): string
    {
        if (!isset($this->cache[$url])) {
            echo "CacheProxy MISS. ";
            $result = $this->downloader->download($url);
            $this->cache[$url] = $result;
        } else {
            echo "CacheProxy HIT. Recuperando resultado de la caché.\n";
        }
        return $this->cache[$url];
    }
}

/**
 * El código del cliente puede emitir varias solicitudes de descarga similares. En este caso,
 * el proxy de caché ahorra tiempo y tráfico sirviendo resultados de la caché.
 *
 * El cliente no está al tanto de que trabaja con un proxy porque trabaja con descargadores a través de la interfaz abstracta.
 */
function clientCode(Downloader $subject)
{
    // ...

    $result = $subject->download("http://example.com/");

    // Las solicitudes de descarga duplicadas podrían ser almacenadas en caché para obtener ganancias de velocidad.

    $result = $subject->download("http://example.com/");

    // ...
}

echo "Ejecutando el código del cliente con el sujeto real:\n";
$realSubject = new SimpleDownloader();
clientCode($realSubject);

echo "\n";

echo "Ejecutando el mismo código del cliente con un proxy:\n";
$proxy = new CachingDownloader($realSubject);
clientCode($proxy);
