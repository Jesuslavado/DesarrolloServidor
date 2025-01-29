<?php
/*
==============================
LISTADO DE FILTROS EN PHP
==============================

PHP proporciona una amplia variedad de filtros para validar y sanear datos usando la función filter_var(). 
Los filtros están organizados en dos categorías principales: VALIDACIÓN y SANEAMIENTO.

-------------------------------------
1. FILTROS DE VALIDACIÓN (VALIDATE_)
-------------------------------------
Estos filtros verifican que un valor cumple con un criterio específico. Si el valor es válido, se devuelve el valor original; 
si no, se devuelve `false`.

- FILTER_VALIDATE_BOOLEAN:
    Verifica si un valor es un booleano (true/false). Acepta "true", "false", "1", "0", "on", "off" (insensible a mayúsculas).
    Ejemplo: filter_var("true", FILTER_VALIDATE_BOOLEAN); // true

- FILTER_VALIDATE_EMAIL:
    Verifica si un valor es una dirección de correo válida.
    Ejemplo: filter_var("correo@example.com", FILTER_VALIDATE_EMAIL);

- FILTER_VALIDATE_FLOAT:
    Verifica si un valor es un número decimal válido. Puede aceptar opciones como un rango mínimo/máximo.
    Ejemplo: filter_var("3.14", FILTER_VALIDATE_FLOAT);

- FILTER_VALIDATE_INT:
    Verifica si un valor es un número entero. Puede aceptar opciones de rango.
    Ejemplo: filter_var("42", FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 100]]);

- FILTER_VALIDATE_IP:
    Verifica si un valor es una dirección IP válida (IPv4 o IPv6).
    Ejemplo: filter_var("192.168.0.1", FILTER_VALIDATE_IP);

- FILTER_VALIDATE_URL:
    Verifica si un valor es una URL válida.
    Ejemplo: filter_var("https://example.com", FILTER_VALIDATE_URL);

- FILTER_VALIDATE_REGEXP:
    Valida un valor contra una expresión regular definida.
    Ejemplo: filter_var("abc123", FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^[a-z0-9]+$/i']]);

-------------------------------------
2. FILTROS DE SANEAMIENTO (SANITIZE_)
-------------------------------------
Estos filtros limpian el valor para hacerlo más seguro, eliminando o escapando caracteres no deseados.

- FILTER_SANITIZE_EMAIL:
    Limpia una cadena para que sea un formato válido de correo electrónico.
    Ejemplo: filter_var("usuario@@example.com", FILTER_SANITIZE_EMAIL); // "usuario@example.com"

- FILTER_SANITIZE_ENCODED:
    Convierte caracteres especiales en entidades URL (para datos que se envían en URL).
    Ejemplo: filter_var("nombre=valor&dato=otro", FILTER_SANITIZE_ENCODED);

- FILTER_SANITIZE_FULL_SPECIAL_CHARS:
    Convierte caracteres especiales en entidades HTML para evitar XSS.
    Ejemplo: filter_var("<script>alert('XSS');</script>", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

- FILTER_SANITIZE_NUMBER_FLOAT:
    Limpia una cadena eliminando caracteres no numéricos, permitiendo decimales o caracteres adicionales como "+" y "-".
    Ejemplo: filter_var("123.45px", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

- FILTER_SANITIZE_NUMBER_INT:
    Limpia una cadena eliminando todo excepto dígitos, signos "+" y "-".
    Ejemplo: filter_var("abc123xyz", FILTER_SANITIZE_NUMBER_INT); // "123"

- FILTER_SANITIZE_SPECIAL_CHARS:
    Convierte caracteres especiales en entidades HTML (similar a htmlspecialchars).
    Ejemplo: filter_var("<b>Texto</b>", FILTER_SANITIZE_SPECIAL_CHARS); // "&lt;b&gt;Texto&lt;/b&gt;"

- FILTER_SANITIZE_STRING (obsoleto en PHP 8.1):
    Limpia una cadena eliminando etiquetas HTML y caracteres especiales.

- FILTER_SANITIZE_URL:
    Limpia una cadena para que sea un formato válido de URL.
    Ejemplo: filter_var("http://example.com/<tag>", FILTER_SANITIZE_URL);

-------------------------------------
3. FLAGS ADICIONALES
-------------------------------------
Algunos filtros tienen opciones o "flags" que se pueden usar para ajustar su comportamiento.

- FILTER_FLAG_ALLOW_FRACTION:
    Permite números decimales en FILTER_SANITIZE_NUMBER_FLOAT.

- FILTER_FLAG_ALLOW_THOUSAND:
    Permite separadores de miles en FILTER_SANITIZE_NUMBER_FLOAT.

- FILTER_FLAG_NO_ENCODE_QUOTES:
    Evita convertir comillas simples y dobles en FILTER_SANITIZE_SPECIAL_CHARS.

- FILTER_FLAG_IPV4 / FILTER_FLAG_IPV6:
    Limita la validación de IP a solo IPv4 o IPv6 en FILTER_VALIDATE_IP.

-------------------------------------
USO COMÚN:
- Validar entradas de formularios (correo, URL, números, etc.).
- Saneamiento de datos para prevenir ataques como XSS o inyección de código.
- Asegurar que los datos procesados sean consistentes y seguros para su uso posterior.

Documentación oficial: https://www.php.net/manual/en/filter.filters.php
*/
?>
