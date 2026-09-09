<?php
/**
 * BD.php
 * ------
 * Conexión a la base de datos "sistema_matricula" usando PDO.
 * crearInstancia() sigue el patrón Singleton: la primera vez crea
 * la conexión, las siguientes veces reutiliza la que ya existe.
 * Ajusta host/usuario/clave aquí si tu MySQL no usa los valores
 * por defecto de XAMPP.
 */
class BD {
    private static $conexion = null;
 
    public static function crearInstancia() {
        if (self::$conexion === null) {
            self::$conexion = new PDO(
                'mysql:host=localhost;dbname=sistema_matricula;charset=utf8',
                'root',
                ''
            );
            self::$conexion->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }
        return self::$conexion;
    }
} 