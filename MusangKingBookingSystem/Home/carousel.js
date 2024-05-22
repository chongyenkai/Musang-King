const carouselImages = document.querySelector('.carousel-images');
const carouselImageWidth = carouselImages.firstElementChild.clientWidth;
const numImages = carouselImages.children.length;
let currentIndex = 0;

function showNextImage() {
  currentIndex = (currentIndex + 1) % numImages;
  updateCarousel();
}

function showPreviousImage() {
  currentIndex = (currentIndex - 1 + numImages) % numImages;
  updateCarousel();
}

function updateCarousel() {
  const offset = -currentIndex * carouselImageWidth;
  carouselImages.style.transition = 'transform 0.5s ease-in-out';
  carouselImages.style.transform = `translateX(${offset}px)`;
}

document.querySelector('.carousel-arrow.next').addEventListener('click', showNextImage);
document.querySelector('.carousel-arrow.prev').addEventListener('click', showPreviousImage);

setInterval(showNextImage, 5000);
