function toggleMobileMenu() {
    var menu = document.getElementById("mobile-menu");
    if (menu.classList.contains("hidden")) {
        menu.classList.remove("hidden");
        menu.classList.add("visible");
    } else {
        menu.classList.remove("visible");
        menu.classList.add("hidden");
    }
}



// Avvia la barra di caricamento appena viene avviato il caricamento della pagina
NProgress.start();

NProgress.configure({ showSpinner: false });

// Al termine del caricamento della pagina, termina la barra
window.addEventListener('load', function () {
    NProgress.done();
});

function redirect(link, stringa){
    window.location.replace(link+".php?" + stringa);
}




/*------------------------------------CAROUSEL--------------------------------*/

    function prevSlide(event, carouselId) {
        event.stopPropagation(); // Ferma la propagazione dell'evento
        const carousel = document.querySelector(`[data-carousel-id="${carouselId}"]`);
        const slides = carousel.querySelectorAll('.carousel-item');
        const indicators = carousel.querySelectorAll('.indicator');
        let currentSlide = Array.from(slides).findIndex(slide => slide.classList.contains('active'));

        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(carouselId, currentSlide);
    }

    function nextSlide(event, carouselId) {
        event.stopPropagation(); // Ferma la propagazione dell'evento
        const carousel = document.querySelector(`[data-carousel-id="${carouselId}"]`);
        const slides = carousel.querySelectorAll('.carousel-item');
        const indicators = carousel.querySelectorAll('.indicator');
        let currentSlide = Array.from(slides).findIndex(slide => slide.classList.contains('active'));

        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(carouselId, currentSlide);
    }

    function goToSlide(event, carouselId, index) {
        event.stopPropagation(); // Ferma la propagazione dell'evento
        showSlide(carouselId, index);
    }

    function showSlide(carouselId, index) {
        const carousel = document.querySelector(`[data-carousel-id="${carouselId}"]`);
        const slides = carousel.querySelectorAll('.carousel-item');
        const indicators = carousel.querySelectorAll('.indicator');

        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            indicators[i].classList.remove('active');
            if (i === index) {
                slide.classList.add('active');
                indicators[i].classList.add('active');
            }
        });

        carousel.querySelector('.carousel-inner').style.transform = `translateX(-${index * 100}%)`;
    }
/*------------------------------------CAROUSEL--------------------------------*/





/*------------------------------------LOGIN--------------------------------*/


    // Seleziona gli elementi
const profileBtn = document.querySelector('.profile-link'); // Icona profilo
const modal = document.getElementById('loginModal');
const overlay = document.getElementById('overlay');
const closeModal = document.getElementById('closeModal');

// Funzione per controllare se l'utente è loggato
const isLoggedIn = () => {
    return document.querySelector(".name-container h1") == null;                //controlla la variabile nomeUtente invece di h1
};

// Mostra il modal solo se l'utente NON è loggato
profileBtn.addEventListener('click', (e) => {
    e.preventDefault();
    if (isLoggedIn()) {
        modal.style.display = 'block';
        overlay.style.display = 'block';
    }
});

// Chiudi il modal cliccando sulla X
closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
    overlay.style.display = 'none';
});

// Chiudi il modal cliccando fuori dal popup
overlay.addEventListener('click', () => {
    modal.style.display = 'none';
    overlay.style.display = 'none';
});

/*------------------------------------LOGIN--------------------------------*/



