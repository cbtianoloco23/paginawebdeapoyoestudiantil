<?php

$host = getenv('MYSQLHOST') ;
$port = getenv('MYSQLPORT') ;
$user = getenv('MYSQLUSER') ;
$pass = getenv('MYSQLPASSWORD') ;
$db   = getenv('MYSQLDATABASE') ;

$conexion = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Esto es vital para los acentos
mysqli_set_charset($conexion, "utf8");
?>
<?php
// 2. Consulta para obtener los programas de la tabla
$query = "SELECT * FROM programas";
$resultado = mysqli_query($conexion, $query); 

// Verificación de seguridad
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Apoyo Estudiantil - CBTis 165</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <img src="logocbtiano.png" alt="Logo CBTis 165" width="100">
    <h1>Portal de Formación Integral CBTis 165 "Leona Vicario"</h1>
</header>

<nav>
    <a href="#academico">Académico</a>
    <a href="#salud">Salud</a>
    <a href="#integral">Integral</a>
    <a href="#talento">Talento</a>
    <a href="#contacto">Contacto</a>
</nav>

<main>
    <section id="academico">
        <h2>Apoyo Académico</h2>
        <div class="grid-programas">
            <div class="card">
                <img src="sinata.jpg" alt="SINATA">
                <div class="card-content">
                    <h3>SINATA</h3>
                    <p>Información sobre tutorías académicas para el apoyo al estudiante.</p>
                </div>
            </div>
            <div class="card">
                <img src="pronafole2.jpg" alt="PRONAFOLE">
                <div class="card-content">
                    <h3>PRONAFOLE</h3>
                    <p>Fomento a la lectura y mejora de habilidades académicas.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="salud">
        <h2>Bienestar y Salud</h2>
        <div class="grid-programas">
            <div class="card">
                <img src="fomalasa.jpg" alt="FOMALASA">
                <div class="card-content">
                    <h3>FOMALASA</h3>
                    <p>Servicios del Consultorio Médico para la comunidad escolar.</p>
                </div>
            </div>
            <div class="card">
                <img src="sexual.jpg" alt="Responsable">
                <div class="card-content">
                    <h3>Consultorio Sexual-Mente Responsable</h3>
                    <p>Asesoría integral en salud mental y reproductiva.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="integral">
        <h2>Desarrollo Integral</h2>
        <div class="grid-programas">
            <div class="card">
                <img src="cineeeeee.jpg" alt="ECALE">
                <div class="card-content">
                    <h3>ECALE</h3>
                    <p>Actividades del Cine Club y expresiones culturales.</p>
                </div>
            </div>
            <div class="card">
                <img src="ambiente.jpg" alt="AMA DGETI">
                <div class="card-content">
                    <h3>AMA DGETI</h3>
                    <p>Programa de cuidado y respeto al medio ambiente.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="tabla-datos">
        <h2>Listado General de Programas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Programa</th>
                    <th>Descripción</th>
                    <th>Área</th>
                    <th>Requisitos</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $resultado = mysqli_query($conexion, "SELECT * FROM programas");
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                        <td>{$fila['id']}</td>
                        <td>{$fila['nombre_programa']}</td>
                        <td>{$fila['informacion']}</td>
                        <td>{$fila['en_que_impacta']}</td>
                        <td>{$fila['requisitos']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <section id="contacto">
        <h2>Buzón de Dudas</h2>
        <div class="formulario-contacto">
            <form action="index.php" method="POST">
                <p>¿Tienes alguna duda sobre los programas? Escríbela aquí:</p>
                <input type="text" name="respuesta" placeholder="Tu pregunta aquí..." required>
                <button type="submit" class="btn-enviar">Enviar Comentario</button>
                <?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['enviar'])){
    // 1. Recibimos datos
    $respuesta = $_POST['respuesta'];
    $sql = "INSERT INTO formulario (respuesta) VALUES ('$respuesta')";
    $query = mysqli_query($conexion, $sql);

    if($query){
        echo "¡Muchas gracias por escribir en que te ayudo mas!.";
    } else {
        // ESTA LÍNEA ES CLAVE: Te dirá qué tiene de malo tu base de datos
        echo "Error de SQL: " . mysqli_error($conexion);
    }
} 
?>
            </form>
        </div>
    </section>
</main>

<footer>
    <p>CBTis 165 "Leona Vicario" | Calle Leona Vicario, Coatepec</p>
    <p>Desarrollado por: <strong>Fabián</strong> | 2026</p>
</footer>

</body>
</html>