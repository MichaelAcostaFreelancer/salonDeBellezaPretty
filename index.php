<?php
// Manejo del formulario de contacto y almacenamiento en SQLite
$successMessage = '';
$errorMessage = '';
$dbPath = __DIR__ . '/data/contacts.db';

if (!is_dir(__DIR__ . '/data')) {
  mkdir(__DIR__ . '/data', 0755, true);
}

try {
  // Si la clase SQLite3 no está disponible, usamos un fallback JSON
  $useSQLite = false;
  $jsonPath = __DIR__ . '/data/contacts.json';

  if (class_exists('SQLite3')) {
    $useSQLite = true;
    $db = new SQLite3($dbPath);
    $db->exec("CREATE TABLE IF NOT EXISTS contacts (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      nombre TEXT NOT NULL,
      telefono TEXT,
      correo TEXT NOT NULL,
      mensaje TEXT,
      created_at TEXT NOT NULL
    )");
  } else {
    // aseguramos el archivo JSON
    if (!file_exists($jsonPath)) {
      file_put_contents($jsonPath, json_encode([]));
    }
  }

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
      if ($useSQLite) {
        $stmt = $db->prepare('INSERT INTO contacts (nombre, telefono, correo, mensaje, created_at) VALUES (:nombre, :telefono, :correo, :mensaje, :created_at)');
        $stmt->bindValue(':nombre', $nombre, SQLITE3_TEXT);
        $stmt->bindValue(':telefono', $telefono, SQLITE3_TEXT);
        $stmt->bindValue(':correo', $correo, SQLITE3_TEXT);
        $stmt->bindValue(':mensaje', $mensaje, SQLITE3_TEXT);
        $stmt->bindValue(':created_at', date('Y-m-d H:i:s'), SQLITE3_TEXT);
        $res = $stmt->execute();

        if ($res) {
          $successMessage = 'Gracias, tu mensaje ha sido registrado.';
        } else {
          $errorMessage = 'Ocurrió un error al guardar. Intenta de nuevo.';
        }
      } else {
        // fallback a JSON
        $records = json_decode(file_get_contents($jsonPath), true) ?: [];
        $records[] = [
          'id' => time(),
          'nombre' => $nombre,
          'telefono' => $telefono,
          'correo' => $correo,
          'mensaje' => $mensaje,
          'created_at' => date('Y-m-d H:i:s')
        ];

        if (file_put_contents($jsonPath, json_encode($records, JSON_PRETTY_PRINT))) {
          $successMessage = 'Gracias, tu mensaje ha sido registrado (almacenado en JSON).';
        } else {
          $errorMessage = 'Ocurrió un error al guardar en el almacenamiento alternativo.';
        }
      }
    }
  }
} catch (Exception $e) {
  $errorMessage = 'Error en la base de datos: ' . $e->getMessage();
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
  <link rel="stylesheet" href="build/css/app.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <header class="header">
    <div class="contenedor contenido-header">
      <h1>Salón de Belleza Pretty</h1>
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
    <img src="material_visual/image1.png" alt="Salón Pretty" class="hero-img" />
    <div class="hero-overlay">
      <div class="hero-text contenedor">
        <h2>Estilo, cuidado y atención personalizada</h2>
        <p class="ubicacion"><strong>📍 San Juan, Calle Eusebio Puello, República Dominicana</strong></p>
        <p class="horario"><strong>⏰ Lunes a domingo 9:00 a.m. - 6:00 p.m.</strong></p>
      </div>
    </div>
  </section>

  <section id="inicio" class="sobre-salon contenedor">
    <div class="imagen">
      <img src="material_visual/image2.png" alt="Interior Salón Pretty" />
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
      <div class="card">
        <h4>Suscripción Básica</h4>
        <p>1 servicio + uso de productos gratis.</p>
        <p class="price">RD $1000</p>
      </div>
      <div class="card">
        <h4>Suscripción Plus</h4>
        <p>2 servicios al mes + promociones exclusivas + uso de productos gratis.</p>
        <p class="price">RD $1500</p>
      </div>
      <div class="card featured">
        <h4>Suscripción Premium</h4>
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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="build/js/app.js"></script>
  <script>
    document.querySelector('.form-contacto')?.addEventListener('submit', async function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      const response = await fetch('#contacto', {
        method: 'POST',
        body: formData
      });
      if (response.ok) {
        Swal.fire({
          title: '¡Éxito!',
          text: 'Tu mensaje ha sido registrado correctamente.',
          icon: 'success',
          confirmButtonColor: '#7d4aad'
        }).then(() => {
          this.reset();
          location.hash = '#contacto';
          location.reload();
        });
      } else {
        Swal.fire({
          title: 'Error',
          text: 'Hubo un problema al enviar el mensaje.',
          icon: 'error',
          confirmButtonColor: '#7d4aad'
        });
      }
    });
  </script>
</body>

</html>