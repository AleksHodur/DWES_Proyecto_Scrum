let slideIndex = 1;
mostrarSlide(slideIndex);

function cambiarSlide(n){
    mostrarSlide(slideIndex += n);
}

function actualSlide(n){
    mostrarSlide(slideIndex = n);
}

function mostrarSlide(n){
    let i;
    let slides = document.getElementsByClassName('mySlide');
    let puntos = document.getElementsByClassName('punto');
    if( n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    for(i = 0; i < slides.length; i++){
        slides[i].style.display = "none";

    }
    for (i = 0; i < puntos.length; i++){
        puntos[i].className = puntos[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    puntos[slideIndex-1].className += " active";
}