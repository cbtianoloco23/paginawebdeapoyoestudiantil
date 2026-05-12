<?php

$host = getenv('MYSQLHOST') ?: "localhost";
$port = getenv('MYSQLPORT') ?: "3306";
$user = getenv('MYSQLUSER') ?: "root";
$pass = getenv('MYSQLPASSWORD') ?: "";
$db   = getenv('MYSQLDATABASE') ?: "railway";

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Apoyo Estudiantil - CBTis 165</title>
    <link rel="stylesheet" href="estilazo.css">
</head>
<body>

    <header>
        <img src="logocbtiano.jpg" alt="Logotipo Institucional CBTis 165">
        <h1>Programas de Formación Integral</h1>
        <p>CBTis 165 "Leona Vicario"</p>
    </header>

    <nav>
        <ul>
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#academico">Apoyo Académico</a></li>
            <li><a href="#salud">Bienestar y Salud</a></li>
            <li><a href="#desarrollo">Desarrollo Integral</a></li>
            <li><a href="#emprendimiento">Emprendimiento y Clubes</a></li>
            <li><a href="#contacto">Contacto</a></li>
        </ul>
    </nav>

    <main id="inicio">
        
        <section id="tabla-dinamica">
            <h2>Catálogo General de Programas</h2>
            <p>Información recuperada en tiempo real de la base de datos institucional:</p>
            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Programa</th>
                        <th>Descripción</th>
                        <th>Área de Impacto</th>
                        <th>Requisitos de Participación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Punto 3: Ciclo while para generar las filas dinámicamente
                    while ($row = mysqli_fetch_array($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td><strong>" . $row['nombre'] . "</strong></td>";
                        echo "<td>" . $row['descripcion'] . "</td>";
                        echo "<td>" . $row['area_impacto'] . "</td>";
                        echo "<td>" . $row['requisitos'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <hr>

        <section id="academico" class="seccion-con-imagen">
            <div class="texto-seccion">
                <h3>Apoyo Académico</h3>
                <p><strong>SINATA (Sistema Nacional de Tutorías):</strong> Es una estrategia para contribuir al desarrollo de las competencias y apoyar a los alumnos en la resolución de problemas de tipo académico, coadyuvando a la mejora de su rendimiento mediante orientación personalizada.</p>
                <p><strong>PRONAFOLE (Fomento a la Lectura):</strong> Invita a los alumnos a acercarse a otros mundos mediante círculos literarios, tertulias, lecturas de poemas y juegos de investigación.</p>
            </div>
            <div class="imagen-seccion">
                <img src="SINATA.jpg" alt="Apoyo Académico">
                <img src="pronafole1.jpg" alt="fomento a la lectura">
            </div>
        </section>

        <section id="salud" class="seccion-con-imagen">
            <div class="texto-seccion">
                <h3>Bienestar y Salud</h3>
                <p><strong>FOMALASA (Fomento a la Salud):</strong> Propicia estilos de vida saludables y bienestar integral. La escuela cuenta con un <strong>Consultorio Médico</strong> extendido y un <strong>Consultorio SEXUAL-MENTE Responsable</strong>.</p>
                <p>También se llevan a cabo estrategias de educación para la prevención de adicciones y promoción de la salud en el aula.</p>
            </div>
            <div class="imagen-seccion">
                <img src="fomalasa.jpg" alt="Bienestar y Salud">
            </div>
        </section>

        <section id="desarrollo" class="seccion-con-imagen">
            <div class="texto-seccion">
                <h3>Desarrollo Integral</h3>
                <p><strong>ECALE (El Cine en la Escuela):</strong> A través de películas seleccionadas, se busca la reflexión grupal y el análisis individual involucrando a alumnos, docentes y padres de familia.</p>
                <p><strong>AMA DGETI (Acciones por el Medio Ambiente):</strong> Busca reforzar el compromiso ciudadano en materia de sustentabilidad y cuidado del ambiente ante los desafíos actuales de nuestra sociedad.</p>
            </div>
            <div class="imagen-seccion">
                <img src="amadgeti.jpg" alt="Desarrollo Integral">
                <img src="ecale.jpg" alt="el cine a la escuela">
            </div>
        </section>

        <section id="emprendimiento" class="seccion-con-imagen">
            <div class="texto-seccion">
                <h3>Emprendimiento y Talento</h3>
                <p><strong>MEEMS (Modelo de Emprendedores):</strong> Desarrolla competencias emprendedoras en los estudiantes para impulsar sus proyectos de vida y negocios.</p>
                <p><strong>Oferta de Clubes:</strong></p>
                <ul>
                    <li><strong>Deportivos:</strong> Fútbol, Voleibol y Basquetbol.</li>
                    <li><strong>Culturales:</strong> Dibujo y Pintura.</li>
                    <li><strong>Ciencias:</strong> Club Galácticos y Robótica.</li>
                </ul>
            </div>
            <div class="imagen-seccion">
                <img src="meems.jpg" alt="Clubes y Emprendimiento">
                <img src="deporte.jpg" alt="clubes">
                <img src="futbol.jpg" alt="clubes">
            </div>
        </section>

        <hr>

        <section id="contacto" class="formulario-consulta">
            <h3>¿Te fue de utilidad la pagina? dejanos tu opinion </h3>
            <p>Envíanos tu opinion.</p>
            <form method="POST">
                <label>opinion:</label>
                <input type="text" id="opinion" name="opinion" placeholder="Tu opinion aqui" required>
                <button type="submit" name="enviar" class="btn-submit">Enviar Consulta</button>
                <?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['enviar'])){
    // 1. Recibimos datos
    $opinion = $_POST['opinion'];
    $sql = "INSERT INTO parecio (opinion) VALUES ('$opinion')";
    $query = mysqli_query($conexion, $sql);

    if($query){
        echo "¡Muchas gracias tu opinion nos ayuda a mejorar!.";
    } else {
        // ESTA LÍNEA ES CLAVE: Te dirá qué tiene de malo tu base de datos
        echo "Error de SQL: " . mysqli_error($conexion);
    }
} 
?>
            </form>
        </section>

    </main>

    <footer>
        <p><strong>CBTis 165 "Leona Vicario"</strong></p>
        <p>Dirección: Coatepec, Veracruz. Carretera Antigua Xalapa-Coatepec KM8.5, Consolapa.</p>
        <p>telefono de contacto:2288162055</p>
        <p>Desarrollado por: <strong>Fabián emir pineda hernandez</strong> | Parcial 2 | 2026</p>
        <p>Redes Sociales: whatsapp:2281196948 / IG - pinedaa_hz</p>
    </footer>

</body>
</html>