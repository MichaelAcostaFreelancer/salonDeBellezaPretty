const galleryImages = [2, 3, 4, 5, 6, 7, 8, 9];

function initializeUI() {
  crearGaleria();
  activarNavegacionFija();
  resaltarEnlace();
  scrollNav();
  cerrarModalConEscape();
}

function activarNavegacionFija() {
  const header = document.querySelector('.header');
  const hero = document.querySelector('.hero');

  if (!header || !hero) return;

  const handleScroll = () => {
    if (hero.getBoundingClientRect().bottom <= 0) {
      header.classList.add('fixed');
    } else {
      header.classList.remove('fixed');
    }
  };

  document.addEventListener('scroll', handleScroll);
  handleScroll();
}

function crearGaleria() {
  const galeria = document.querySelector('.galeria-imagenes');
  if (!galeria) return;

  galleryImages.forEach((imageNumber) => {
    const img = document.createElement('img');
    img.loading = 'lazy';
    img.src = `contenidoVisual/image${imageNumber}.png`;
    img.alt = `Galería Salón Pretty ${imageNumber}`;
    img.classList.add('galeria-item');
    img.addEventListener('click', () => mostrarImagen(imageNumber));
    galeria.appendChild(img);
  });
}

function mostrarImagen(imageNumber) {
  const modal = document.createElement('div');
  modal.classList.add('modal');
  modal.addEventListener('click', cerrarModal);

  const image = document.createElement('img');
  image.src = `contenidoVisual/image${imageNumber}.png`;
  image.alt = `Imagen grande Salón Pretty ${imageNumber}`;
  image.classList.add('modal-image');

  const closeButton = document.createElement('button');
  closeButton.type = 'button';
  closeButton.classList.add('btn-cerrar');
  closeButton.textContent = 'X';
  closeButton.addEventListener('click', (event) => {
    event.stopPropagation();
    cerrarModal();
  });

  modal.appendChild(image);
  modal.appendChild(closeButton);
  document.body.appendChild(modal);
  document.body.classList.add('overflow-hidden');
}

function cerrarModal() {
  const modal = document.querySelector('.modal');
  if (!modal) return;
  modal.classList.add('fadeOut');

  setTimeout(() => {
    modal.remove();
    document.body.classList.remove('overflow-hidden');
  }, 200);
}

function cerrarModalConEscape() {
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      cerrarModal();
    }
  });
}

function resaltarEnlace() {
  document.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.navegacion-principal a');
    let currentSection = '';

    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.clientHeight;
      if (window.scrollY >= sectionTop - sectionHeight / 3) {
        currentSection = section.id;
      }
    });

    navLinks.forEach((link) => {
      link.classList.toggle('active', link.getAttribute('href') === `#${currentSection}`);
    });
  });
}

function scrollNav() {
  const navLinks = document.querySelectorAll('.navegacion-principal a');

  navLinks.forEach((link) => {
    link.addEventListener('click', (event) => {
      event.preventDefault();
      const target = document.querySelector(link.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
}

document.addEventListener('DOMContentLoaded', initializeUI);
