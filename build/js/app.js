const galleryItems = [
  { src: 'material_visual/image.png', alt: 'Salón Pretty foto 1' },
  { src: 'material_visual/image8.png', alt: 'Salón Pretty foto 2' },
  { src: 'material_visual/image9.png', alt: 'Salón Pretty foto 3' },
  { src: 'material_visual/image2.png', alt: 'Salón Pretty foto 4' },
  { src: 'material_visual/image3.png', alt: 'Salón Pretty foto 5' },
  { src: 'material_visual/image4.png', alt: 'Salón Pretty foto 6' },
  { src: 'material_visual/image5.png', alt: 'Salón Pretty foto 7' },
  { src: 'material_visual/image6.png', alt: 'Salón Pretty foto 8' },
  { src: 'material_visual/image7.png', alt: 'Salón Pretty foto 9' }
];

function crearGaleria() {
  const galeria = document.querySelector('.galeria-imagenes');
  if (!galeria) return;

  galleryItems.forEach((item) => {
    const card = document.createElement('article');
    card.className = 'galeria-item';

    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'galeria-boton';
    button.addEventListener('click', () => mostrarImagen(item));

    const picture = document.createElement('picture');
    const sourceAvif = document.createElement('source');
    sourceAvif.type = 'image/avif';
    sourceAvif.srcset = item.src.replace(/\.png$/i, '.avif');

    const sourceWebp = document.createElement('source');
    sourceWebp.type = 'image/webp';
    sourceWebp.srcset = item.src.replace(/\.png$/i, '.webp');

    const img = document.createElement('img');
    img.loading = 'lazy';
    img.decoding = 'async';
    img.src = item.src;
    img.alt = item.alt;
    img.className = 'galeria-thumb';

    picture.append(sourceAvif, sourceWebp, img);
    button.appendChild(picture);
    card.appendChild(button);
    galeria.appendChild(card);
  });
}

function mostrarImagen(item) {
  const modal = document.createElement('div');
  modal.className = 'modal';

  const modalContent = document.createElement('div');
  modalContent.className = 'modal-contenido';

  const picture = document.createElement('picture');
  const sourceAvif = document.createElement('source');
  sourceAvif.type = 'image/avif';
  sourceAvif.srcset = item.src.replace(/\.png$/i, '.avif');

  const sourceWebp = document.createElement('source');
  sourceWebp.type = 'image/webp';
  sourceWebp.srcset = item.src.replace(/\.png$/i, '.webp');

  const img = document.createElement('img');
  img.src = item.src;
  img.alt = item.alt;
  img.loading = 'lazy';
  img.decoding = 'async';

  picture.append(sourceAvif, sourceWebp, img);
  modalContent.appendChild(picture);

  const closeButton = document.createElement('button');
  closeButton.type = 'button';
  closeButton.className = 'btn-cerrar';
  closeButton.textContent = '×';
  closeButton.addEventListener('click', cerrarModal);

  modalContent.appendChild(closeButton);
  modal.appendChild(modalContent);

  modal.addEventListener('click', (event) => {
    if (event.target === modal) {
      cerrarModal();
    }
  });

  document.body.classList.add('overflow-hidden');
  document.body.appendChild(modal);
}

function cerrarModal() {
  const modal = document.querySelector('.modal');
  if (!modal) return;

  modal.classList.add('fadeOut');
  setTimeout(() => {
    modal.remove();
    document.body.classList.remove('overflow-hidden');
  }, 350);
}

function resaltarEnlace() {
  document.addEventListener('scroll', () => {
    const secciones = document.querySelectorAll('section');
    const enlaces = document.querySelectorAll('.navegacion-principal a');
    let activeId = '';

    secciones.forEach((section) => {
      const topOffset = section.offsetTop;
      const sectionHeight = section.clientHeight;
      if (window.scrollY >= topOffset - sectionHeight / 3) {
        activeId = section.id;
      }
    });

    enlaces.forEach((link) => {
      link.classList.toggle('active', link.getAttribute('href') === `#${activeId}`);
    });
  });
}

function scrollNav() {
  document.querySelectorAll('.navegacion-principal a').forEach((link) => {
    link.addEventListener('click', (event) => {
      event.preventDefault();
      const target = event.target.getAttribute('href');
      document.querySelector(target).scrollIntoView({ behavior: 'smooth' });
    });
  });
}

function mostrarAlertas() {
  const success = document.querySelector('.alert.success');
  const error = document.querySelector('.alert.error');

  if (success) {
    Swal.fire({
      icon: 'success',
      title: '¡Perfecto!',
      text: success.textContent.trim(),
      background: '#ffffff',
      color: '#3a0e46',
      confirmButtonColor: '#7d4aad'
    });
  }

  if (error) {
    Swal.fire({
      icon: 'error',
      title: 'Algo salió mal',
      text: error.textContent.trim(),
      background: '#ffffff',
      color: '#3a0e46',
      confirmButtonColor: '#f24d9d'
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  crearGaleria();
  resaltarEnlace();
  scrollNav();
  mostrarAlertas();
});