<?php
$successMessage = '';
$errorMessage = '';

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'root';
$dbName = 'salon_pretty';
$dbPort = 3306;

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);

if ($conn->connect_error) {
  $errorMessage = 'Error de conexión a la base de datos: ' . $conn->connect_error . '. Verifica que el servidor MySQL esté activo y que las credenciales sean correctas.';
} else {
  $conn->set_charset('utf8mb4');

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_contacto'])) {
    $nombre = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    if ($nombre === '' || $correo === '') {
      $errorMessage = 'Por favor completa los campos requeridos.';
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
      $errorMessage = 'Ingresa un correo válido.';
    } else {
      $stmt = $conn->prepare('INSERT INTO contacts (nombre, telefono, correo, mensaje) VALUES (?, ?, ?, ?)');
      if ($stmt) {
        $stmt->bind_param('ssss', $nombre, $telefono, $correo, $mensaje);
        if ($stmt->execute()) {
          $successMessage = 'Gracias, tu mensaje ha sido guardado correctamente.';
        } else {
          $errorMessage = 'Ocurrió un error al guardar en la base de datos.';
        }
        $stmt->close();
      } else {
        $errorMessage = 'Error en la preparación de la consulta.';
      }
    }
  }

  $conn->close();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Salón de Belleza Pretty</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="build/css/app.css?v=2" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <header class="header">
    <div class="contenedor contenido-header">
      <h1 class="texto-header">Salón de Belleza Pretty</h1>
      <nav class="navegacion-principal">
        <a href="#inicio">Inicio</a>
        <a href="#servicios">Servicios</a>
        <a href="#galeria">Galería</a>
        <a href="#suscripciones">Suscripciones</a>
        <a href="#contacto">Contacto</a>
      </nav>
    </div>
  </header>

  <section class="hero">
    <img src="contenidoVisual/image1.png" alt="Salón Pretty" class="hero-img" />
    <div class="hero-overlay">
      <div class="hero-text contenedor">
        <h2>Estilo, cuidado y atención personalizada</h2>
        <div class="hero-meta-card">
          <p class="mini-card"><strong>📍 San Juan, Calle Eusebio Puello, República Dominicana</strong></p>
          <p class="mini-card"><strong>⏰ Lunes a domingo 9:00 a.m. - 6:00 p.m.</strong></p>
        </div>
      </div>
    </div>
  </section>

  <section id="inicio" class="sobre-salon contenedor">
    <div class="imagen">
      <img src="contenidoVisual/image2.png" alt="Interior Salón Pretty" />
    </div>
    <div class="contenido-salon">
      <h2>Bienvenida a Salón de Belleza Pretty</h2>
      <p class="fecha">Fundado el 26 de junio de 2020</p>
      <p>Salón de Belleza Pretty ofrece estilo y cuidado con una experiencia cálida y profesional. La propietaria, Sra. Kari, dirige un equipo que trabaja con respeto, responsabilidad y una atención excepcional.</p>
      <p>Estamos ubicados en San Juan, Calle Eusebio Puello, y buscamos que cada visita deje una sonrisa y un resultado impecable.</p>
    </div>
  </section>

  <section class="info-grid contenedor">
    <h3>Nuestra esencia</h3>
    <div class="grid-cards">
      <div class="info-card">
        <h4>Misión</h4>
        <p>Expandir el salón y lograr que más personas reconozcan nuestros servicios y calidad.</p>
      </div>
      <div class="info-card">
        <h4>Visión</h4>
        <p>Ser el salón preferido en San Juan por la atención amable y resultados de excelencia.</p>
      </div>
      <div class="info-card">
        <h4>Valores</h4>
        <p>Respeto, responsabilidad y buena atención al cliente son el corazón de nuestro trabajo.</p>
      </div>
    </div>
  </section>

  <section id="servicios" class="servicios contenedor">
    <h3>Servicios</h3>
    <div class="servicio-cards">
      <div class="servicio-card">
        <h4>Corte y Peinado</h4>
        <p>Asesoría y acabado personalizado para cada estilo.</p>
      </div>
      <div class="servicio-card">
        <h4>Tintes y Color</h4>
        <p>Coloración profesional y tratamientos para un cabello brillante.</p>
      </div>
      <div class="servicio-card">
        <h4>Manicura y Pedicura</h4>
        <p>Acabados cuidados y diseños delicados para manos y pies.</p>
      </div>
      <div class="servicio-card">
        <h4>Tratamientos Capilares</h4>
        <p>Nutrición profunda para un cabello sano y renovado.</p>
      </div>
    </div>
  </section>

  <section id="galeria" class="galeria contenedor">
    <h3>Galería De Fotos</h3>
    <div class="galeria-imagenes" aria-label="Galería de imágenes de Salón Pretty"></div>
  </section>

  <section id="suscripciones" class="suscripciones contenedor">
    <h3>Suscripciones</h3>
    <div class="cards">
      <div class="card featured-basic">
        <h4 class="nombre-card">Suscripción Básica</h4>
        <p>1 servicio + uso de productos gratis.</p>
        <p class="price">RD $1000</p>
      </div>
      <div class="card featured-plus">
        <h4 class="nombre-card">Suscripción Plus</h4>
        <p>2 servicios al mes + promociones exclusivas + uso de productos gratis.</p>
        <p class="price">RD $1500</p>
      </div>
      <div class="card featured">
        <h4 class="nombre-card">Suscripción Premium</h4>
        <p>Servicios ilimitados por un mes + uso de productos premium gratis + promociones exclusivas + prioridad en reservas.</p>
        <p class="price">RD $2500</p>
      </div>
    </div>
  </section>

  <section id="contacto" class="contacto contenedor">
    <h3>Contacto</h3>

    <?php if ($successMessage): ?>
      <div class="alert success"><?= htmlspecialchars($successMessage) ?></div>
    <?php endif; ?>

    <?php if ($errorMessage): ?>
      <div class="alert error"><?= htmlspecialchars($errorMessage) ?></div>
    <?php endif; ?>

    <form action="#contacto" method="POST" class="form-contacto">
      <input type="hidden" name="form_contacto" value="1" />
      <div class="form-row">
        <label>Nombre completo *</label>
        <input type="text" name="nombre" required />
      </div>
      <div class="form-row">
        <label>Teléfono</label>
        <input type="text" name="telefono" />
      </div>
      <div class="form-row">
        <label>Correo *</label>
        <input type="email" name="correo" required />
      </div>
      <div class="form-row">
        <label>Mensaje</label>
        <textarea name="mensaje" rows="4"></textarea>
      </div>
      <div class="form-actions">
        <button type="submit">Enviar</button>
      </div>
    </form>
  </section>

  <footer class="footer">
    <p>Todos los derechos reservados. <?php echo date('Y'); ?> &copy;</p>
  </footer>

  <script src="build/js/app.js?v=2"></script>
  <?php if ($successMessage): ?>
    <script>
      Swal.fire({
        title: '¡Éxito!',
        text: <?= json_encode($successMessage) ?>,
        icon: 'success',
        confirmButtonColor: '#7d4aad'
      });
    </script>
  <?php elseif ($errorMessage): ?>
    <script>
      Swal.fire({
        title: 'Error',
        text: <?= json_encode($errorMessage) ?>,
        icon: 'error',
        confirmButtonColor: '#7d4aad'
      });
    </script>
  <?php endif; ?>
</body>

</html>