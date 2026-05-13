<?php
// Configuración de conexión (Mantenemos tu lógica de Railway/Environment)
$host = getenv('MYSQLHOST');
$port = getenv('MYSQLPORT');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');
$db   = getenv('MYSQLDATABASE');

$conexion = mysqli_connect($host, $user, $pass, $db, $port);
if (!$conexion) { die("Error de conexión: " . mysqli_connect_error()); }
mysqli_set_charset($conexion, "utf8");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoyo Estudiantil - CBTis 165</title>
    <link rel="stylesheet" href="estilon.css">
</head>
<body>

<header>
    <div class="header-content">
        <img src="logocbtiano.jpg" alt="Logo CBTis 165" class="logo">
        <h1>Portal de Formación Integral CBTis 165</h1>
        <p class="subtitulo">"Leona Vicario" - Coatepec, Veracruz</p>
    </div>
</header>

<nav>
    <a href="#academico">Académico</a>
    <a href="#salud">Salud</a>
    <a href="#integral">Integral</a>
    <a href="#tabla-datos">Programas</a>
    <a href="#contacto">Buzón</a>
</nav>

<main class="container">
    
    <section id="academico">
        <h2 class="section-title">Apoyo Académico</h2>
        <div class="grid-programas">
            <div class="card">
                <img src="sinata.jpg" alt="SINATA">
                <div class="card-body">
                    <h3>SINATA</h3>
                    <p>El Sistema Nacional de Tutorías brinda acompañamiento personalizado para disminuir el índice de reprobación y fortalecer tu trayectoria académica.</p>
                </div>
            </div>
            <div class="card">
                <img src="pronafole2.jpg" alt="PRONAFOLE">
                <div class="card-body">
                    <h3>PRONAFOLE</h3>
                    <p>Programa Nacional de Fomento a la Lectura. Participa en círculos de lectura, tertulias literarias y concursos de creación de textos.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="salud">
        <h2 class="section-title">Bienestar y Salud</h2>
        <div class="grid-programas">
            <div class="card">
                <img src="fomalasa.jpg" alt="FOMALASA">
                <div class="card-body">
                    <h3>FOMALASA</h3>
                    <p>Fomento a la Salud. Promovemos estilos de vida saludables, prevención de adicciones y campañas de vacunación para toda la comunidad.</p>
                </div>
            </div>
            <div class="card">
                <img src="sexual.jpg" alt="Responsable">
                <div class="card-body">
                    <h3>Salud Mental y Reproductiva</h3>
                    <p>Asesoría especializada para jóvenes. Contamos con consultorio "Sexual-Mente Responsable" para informarte y cuidarte.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="integral">
        <h2 class="section-title">Desarrollo Integral</h2>
        <div class="grid-programas">
            <div class="card">
                <img src="cineeeeee.jpg" alt="ECALE">
                <div class="card-body">
                    <h3>ECALE (Cine Club)</h3>
                    <p>El Cine en la Escuela. Analizamos películas seleccionadas para fomentar la reflexión grupal, los valores y el pensamiento crítico de los alumnos.</p>
                </div>
            </div>
            <div class="card">
                <img src="ambiente.jpg" alt="AMA DGETI">
                <div class="card-body">
                    <h3>AMA DGETI</h3>
                    <p>Acciones por el Medio Ambiente. Participa en reforestaciones, reciclaje y proyectos de sustentabilidad para cuidar nuestro entorno.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="tabla-datos">
        <h2 class="section-title">Catálogo de Programas</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Programa</th>
                        <th>Impacto</th>
                        <th>Requisitos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $resultado = mysqli_query($conexion, "SELECT * FROM programas");
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>
                            <td>{$fila['id']}</td>
                            <td><strong>{$fila['nombre']}</strong></td>
                            <td>{$fila['en_que_impacta']}</td>
                            <td>{$fila['requisitos']}</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <section id="contacto" class="buzon-area">
        <h2>Buzón de Dudas</h2>
        <form method="POST">
            <p>Escribe tu duda y te apoyaremos a la brevedad:</p>
            <div class="form-group">
                <input type="text" name="respuesta" placeholder="Escribe aquí tu duda o comentario..." required>
                <button type="submit" name="enviar" class="btn-enviar">Enviar</button>
            </div>
            <?php
            if(isset($_POST['enviar'])){
                $respuesta = mysqli_real_escape_string($conexion, $_POST['respuesta']);
                $sql = "INSERT INTO formulario (respuesta) VALUES ('$respuesta')";
                if(mysqli_query($conexion, $sql)){
                    echo "<p class='msg-success'>¡Mensaje enviado con éxito!</p>";
                }
            }
            ?>
        </form>
    </section>
</main>

<footer>
    <div class="footer-info">
        <p><strong>CBTis No. 165 "Leona Vicario"</strong></p>
        <p>Calle Leona Vicario S/N, Col. Consolapa, C.P. 91500</p>
        <p>Coatepec, Veracruz, México.</p>
        <hr>
        <p>Desarrollado por: <strong>Carlos Pedraza</strong> | 2º Parcial | 2026</p>
    </div>
</footer>

</body>
</html>
