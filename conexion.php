<?php
// Datos de configuración del servidor (CBTis 165 - Proyecto Parcial 2)
$host = "localhost";    // El servidor de BD (usualmente localhost)
$user = "root";         // Tu usuario de MySQL
$pass = "";             // Tu contraseña (déjala vacía si usas XAMPP por defecto)
$db   = "formacion_integral"; // El nombre de la base de datos que creaste

// Crear la conexión
$conexion = mysqli_connect($host, $user, $pass, $db);

// Comprobar si la conexión fue exitosa
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Configurar el conjunto de caracteres a UTF-8 para evitar problemas con acentos y la 'ñ'
mysqli_set_charset($conexion, "utf8");

?>