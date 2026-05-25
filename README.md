# 💇‍♀️ Salón de Belleza Pretty — Documentación de la maqueta y el proyecto

**Salón de Belleza Pretty** es una página de presentación responsive diseñada para mostrar un salón de belleza con una experiencia visual cuidada, propuesta de servicios, galería de trabajos y contacto directo.

## 🎨 Maqueta de la página
La maqueta de esta página está pensada para presentar una experiencia elegante y moderna, con énfasis en los siguientes bloques:

1. **Header fijo y claro**
   * Navegación superior con enlaces internos a secciones principales.
   * Diseño transparente y compacto con efecto fijo al hacer scroll.

2. **Hero de alto impacto**
   * Imagen de fondo full cover que ocupa la primera vista.
   * Overlay degradado para mejorar contraste y legibilidad.
   * Mensaje principal claro y directo: "Estilo, cuidado y atención personalizada".
   * Tarjeta de datos rápidos con ubicación y horario.

3. **Sección "Inicio" / Sobre el salón**
   * Imagen representativa del salón.
   * Texto corporativo con bienvenida, historia breve y enfoque en calidad de servicio.
   * Datos destacados como la fecha de fundación y la promesa de atención profesional.

4. **Servicios**
   * Grid responsivo con tarjetas de servicios clave.
   * Cada tarjeta tiene título y descripción breve.
   * Transiciones suaves para realzar la interacción.

5. **Galería**
   * Galería de imágenes con tarjetas clicables.
   * Modal ligero para ver la imagen ampliada.
   * Diseño ordenado y flexible con `CSS Grid`.

6. **Suscripciones**
   * Tabla de opciones con planes básicos, plus y premium.
   * Precios y beneficios destacados.
   * Borde y sombra suave para diferenciar cada opción.

7. **Contacto**
   * Formulario de contacto integrado en la misma página.
   * Mensajes de éxito/error dinámicos con SweetAlert2.
   * Validación básica de campos requeridos y correo.

8. **Footer refinado**
   * Base de página minimalista con fondo degradado.
   * Texto centrado y legible.
   * Transición visual suave respecto al contenido previo.

## 📐 Detalles de diseño visual
* **Responsivo**: el diseño se adapta a móviles, tabletas y escritorio usando `flexbox` y `grid`.
* **Tipografía**: Montserrat para un look moderno y legible.
* **Colores**: paleta elegante basada en tonos lavanda, rosa suave y contraste oscuro.
* **Sombras y transiciones**: elementos con sombras suaves, hover en tarjetas, animaciones de entrada y transiciones suaves.
* **Imágenes**: el hero y la galería usan imágenes optimizadas para entregar una experiencia visual atractiva sin recargar el layout.

## 🧩 Arquitectura de la página
* `index.php` — Página principal que contiene toda la estructura HTML y el formulario de contacto.
* `src/scss/app.scss` — Punto de entrada SASS que agrupa estilos modulares.
* `src/scss/layout/_index.scss` — Estilos principales de layout, hero, secciones, galería y formulario.
* `src/scss/layout/_header.scss` — Estilos del header y navegación.
* `src/scss/layout/_footer.scss` — Estilos del footer.
* `src/js/app.js` — JavaScript para navegación suave, secciones activas, galería modal y header fijo.
* `build/css/app.css` — CSS generado para producción.
* `build/js/app.js` — JS compilado (ya presente en el proyecto).
* `contenidoVisual/` — Imágenes del salón usadas en hero y galería.

## 🛠️ Flujo de interacción
* La navegación interna simula un sitio de una sola página con desplazamiento suave en `scrollIntoView`.
* El header recibe clase `fixed` al bajar el scroll para mantenerse visible.
* La galería genera imágenes dinámicamente desde JavaScript y abre un modal al hacer clic.
* El formulario de contacto envía datos mediante POST a la misma página y muestra alerta de éxito/error.

## 💻 Cómo ejecutar el proyecto
1. Abre la carpeta del proyecto en un servidor local con PHP (XAMPP, WAMP, Laragon, etc.).
2. Accede a `index.php` desde el navegador.
3. Si editas estilos, recompílalos con:

```bash
npx sass src/scss:build/css
```

4. Si usas Gulp para tareas adicionales, ejecuta:

```bash
npm run dev
```

## 📁 Estructura del repositorio
```text
proyectoFinalIsmerliYHeilisa/
├── build/
│   ├── css/app.css
│   └── js/app.js
├── contenidoVisual/
│   ├── image1.png
│   ├── image2.png
│   └── image3.png ...
├── src/
│   ├── js/app.js
│   └── scss/
│       ├── app.scss
│       └── layout/
│           ├── _footer.scss
│           ├── _header.scss
│           ├── _galeria.scss
│           └── _index.scss
├── index.php
├── gulpfile.js
├── package.json
└── README.md
```

## 🧹 Limpieza realizada
* Se eliminaron componentes y estilos de festival/EDM que no se usan.
* Se concentró el diseño en la identidad de un salón de belleza.
* Se mantuvo el código esencial: hero, servicios, galería, suscripciones y contacto.

## 📌 Observaciones finales
Esta documentación describe la maqueta actual de la página, su propósito visual y técnico, y los componentes clave del proyecto. El README está diseñado para que cualquier desarrollador entienda rápidamente la intención de la interfaz y cómo trabajar con el proyecto.