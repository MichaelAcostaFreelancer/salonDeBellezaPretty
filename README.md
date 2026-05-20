# 💇‍♀️ Salón de Belleza Pretty — Plataforma Web & Maquetación UI/UX

> Una solución web moderna, elegante y completamente responsiva diseñada para optimizar la experiencia visual y la gestión de servicios en un salón de belleza. El proyecto destaca por una interfaz limpia, una estética sofisticada y una arquitectura de componentes fluida.

---

## 📸 Maqueta y Arquitectura Visual (Mockup UI/UX)

La interfaz de **Salón de Belleza Pretty** ha sido maquetada siguiendo principios de diseño centrado en el usuario, priorizando la accesibilidad, la elegancia visual y una navegación intuitiva que evoca la atmósfera del sector de la estética y el estilismo.

### 🖥️ Vista Principal y Flujo de la Interfaz
* **Header Estilizado:** Barra de navegación minimalista que incluye accesos directos rápidos a los servicios, galerías, cotizaciones y citas, adaptándose de forma elástica mediante menús hamburguesa en entornos móviles.
* **Sección Hero de Alto Impacto:** Diseñada para capturar la atención de las usuarias desde el primer segundo, utilizando tipografías refinadas combinadas con imágenes de alta resolución optimizadas para carga rápida.
* **Grid de Servicios:** Maquetación modular en cuadrícula para presentar de forma ordenada y atractiva los diferentes tratamientos (Corte, Color, Peinado, Manicura), integrando efectos visuales suaves al pasar el cursor (*hover*).
* **Módulo de Citas Integrado:** Interfaz limpia con formularios validados visualmente para agilizar el agendamiento y evitar la fatiga cognitiva del usuario.

### 📱 Diseño Responsivo y Grid System
* **Mobile-First Structure:** El diseño fue concebido para lucir impecable en smartphones, reorganizando de forma automática los bloques de contenido mediante estructuras fluidas basadas en *Flexbox* y *CSS Grid*.
* **Optimización de Assets:** Todo el apartado multimedia (imágenes de cortes, paletas y logos) está estructurado para renderizarse de forma nítida en pantallas de alta densidad de píxeles (Retina / pantallas móviles).

---

## 🎨 Sistema de Diseño, Estilos y Procesamiento

La identidad visual del software utiliza un balance de tonos suaves que transmiten frescura, belleza y profesionalismo:

* **Estilos Modulares con SASS:** La maquetación no utiliza CSS plano; se estructura a través de arquitectura SASS organizada en módulos independientes (variables, componentes, layouts y base) para un mantenimiento ágil de la interfaz.
* **Paleta de Colores:** Combinación armónica de tonos pasteles elegantes, blancos puros para zonas de respiro visual, y contrastes oscuros definidos en la tipografía para garantizar la máxima legibilidad conforme a las pautas WCAG.
* **Automatización del Diseño:** Uso de **Gulp** como motor de tareas para compilar, minificar y optimizar automáticamente las hojas de estilo, garantizando que el diseño final cargue en el navegador en milisegundos.

---

## 🛠️ Tecnologías y Ecosistema Técnico

El desarrollo de la maqueta y la lógica del sitio se compone de las siguientes tecnologías:

* **Arquitectura de Vistas:** PHP para la modularización de componentes repetitivos (Header, Footer, Modales) y manejo dinámico.
* **Diseño y Estilos:** SASS (Syntactically Awesome Style Sheets) compilado a CSS3 avanzado.
* **Automatizador de Tareas:** Gulp (Compilación de hojas de estilo y procesamiento optimizado de assets).
* **Interactividad frontend:** JavaScript para animaciones dinámicas de la interfaz y control del DOM.

---

## 📁 Estructura del Repositorio

La organización de los archivos mantiene una separación clara entre el entorno de desarrollo de diseño y el código listo para producción:

```text
├── src/                # Código fuente de diseño
│   ├── scss/           # Estructura modular de estilos SASS
│   └── js/             # Scripts de interactividad de la UI
├── build/              # Código compilado y optimizado por Gulp (CSS/JS finales)
├── img/                # Galería de imágenes y recursos visuales del salón
├── includes/           # Componentes repetitivos maquetados en PHP (templates)
├── index.html / .php   # Estructura de la página principal
└── README.md           # Documentación del proyecto