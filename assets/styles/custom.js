let mainImage = document.querySelector('#imgMain')
mainImage.addEventListener('click',changeImage);
let images = document.querySelectorAll('#imgNext');
images.forEach(img => img.addEventListener('click',changeImage));

function changeImage(event) {
   mainImage.src = event.target.src;
}

