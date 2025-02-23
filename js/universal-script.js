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

function redirect(link){
    window.location.replace(link+".html");
}