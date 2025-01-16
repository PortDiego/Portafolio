function modalBienvenida(){
    document.getElementById("modalBienvenida").style.display="block";
    document.getElementById("tituloCabecera").style.animationPlayState="paused";
    document.getElementById("subTituloCabecera").style.animationPlayState="paused";
    document.documentElement.style.overflow="hidden";
    document.getElementById("botonCerrarMBL").focus();
}

function cerrarMBB(){
    document.getElementById("modalBienvenida").style.display="none";
    document.getElementById("tituloCabecera").style.animationPlayState="running";
    document.getElementById("subTituloCabecera").style.animationPlayState="running";
    document.documentElement.style.overflowY="auto";
    setInterval(slideShowAnim, 3000);
}


/* Aquí empieza el codigo del menú */
var posPreviaScroll = document.documentElement.scrollTop;

window.onscroll = function(){esconderMostrarMenu()};

function esconderMostrarMenu(){
    var posActualScroll = document.documentElement.scrollTop;

    if (posPreviaScroll>posActualScroll){
        /* Cuando subimos mostramos el menú */
        document.getElementById("navBar").style.top = "0";

        if(posActualScroll>200){
            document.getElementById("navBar").style.height = "50px";
            document.getElementById("navBar").style.fontSize = "1.75rem";
            document.getElementById("opciones").style.lineHeight = "50px";
            document.getElementById("subGenero").style.top = "50px";
            document.getElementById("subLanz").style.top = "50px";
            document.getElementById("logo").style.padding = "0px";
        }
        else{
            document.getElementById("navBar").style.height = "150px";
            document.getElementById("navBar").style.fontSize = "2rem";
            document.getElementById("opciones").style.lineHeight = "150px";
            document.getElementById("subGenero").style.top = "100px";
            document.getElementById("subLanz").style.top = "100px";
            document.getElementById("logo").style.padding = "18px";
        }
    }
    else{
        /* Cuando bajamos escondemos el menú */
        if(posActualScroll<200){
            document.getElementById("navBar").style.height = "50px";
            document.getElementById("navBar").style.fontSize = "1.75rem";
            document.getElementById("opciones").style.lineHeight = "50px";
            document.getElementById("logo").style.padding = "0px";
            document.getElementById("subGenero").style.top = "50px";
            document.getElementById("subLanz").style.top = "50px";
        }
        else{
            document.getElementById("navBar").style.top = "-150px";
        }
    }

    posPreviaScroll = posActualScroll;
}

/* Aqui empieza el código de las Categorias de los Generos */
function marcarCategoria(contenedorAMostrar, tabCliclada){
    var listaPestana = document.getElementsByClassName("contenedorCategoria");
    for (var i=0; i<listaPestana.length; i++){
        listaPestana[i].style.display = "none";
    }

    document.getElementById(contenedorAMostrar).style.display = "block";

    var tabLinks = document.getElementsByClassName("etiquetaGenero");
    for(var i=0; i<tabLinks.length; i++){
        tabLinks[i].classList.remove("pestanaActiva");
    }

    document.getElementById(tabCliclada).classList.add("pestanaActiva");

    var juegos = document.getElementsByClassName("juego");
    for(var i=0; i<juegos.length; i++){
        juegos[i].classList.remove("animacionCategorias");
    }

    var categoriasCont = document.getElementById(contenedorAMostrar).children;
    for(var i=0; i<categoriasCont.length; i++){
        categoriasCont[i].classList.add("animacionCategorias");
    }
}

/* Aqui empieza el código del slideshow automático */
var bgCounter = 0;
function heroSlideshow(){
    
    var listaImgUrl = [
        "url('Media/HeroImage.jpg')",
        "url('Media/HeroImage2.jpg')",
        "url('Media/HeroImage3.jpg')"
    ];

    bgCounter++;

    if(bgCounter == listaImgUrl.length){
        bgCounter = 0;
    }

    document.getElementById("encabezado").style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4))," + listaImgUrl[bgCounter];

}

/* Aqui empieza el código del slideshow con animación */
var counterNext = 0;
var counterMain = 0;

function slideShowAnim(){
    var listaImgAnim = document.getElementsByClassName("fondosHero");
    counterNext++;
    counterMain = counterNext-1;

    if(counterNext==listaImgAnim.length){
        counterNext = 0;
    }

    if(counterMain<0){
        counterMain = listaImgAnim.length-1;
    }

    for(var i=0; i<listaImgAnim.length; i++){
        listaImgAnim[i].classList.remove("nextSlide");
        listaImgAnim[i].classList.remove("mainslide");
        listaImgAnim[i].classList.remove("hiddenSlide");

        if(i==counterNext){
            listaImgAnim[i].classList.add("nextSlide");
        }
        else if(i==counterMain){
            listaImgAnim[i].classList.add("mainSlide");
        }
        else{
            listaImgAnim[i].classList.add("hiddenSlide");
        }
    }
}


/* Aquí empieza el código del lightbox */

/* function modalLightBoxG(){
    document.getElementById("modalLightBoxG").style.display = "block";
    document.documentElement.style.overflow = "hidden";

    var listaImgGaleria = document.getElementsByClassName("imgGal");
    // console.log(listaImgGaleria);

    for (var i=0; i<listaImgGaleria.length; i++){
        listaRutaImgGal.push(listaImgGaleria[i].src);
    }

    document.getElementById("imageToShow").innerHTML = "<img class='imageLightBox' src='Media/galeria1.png'>";
} */

var listaRutaImgGal = [];
var numeroImg = 0;

function readyLightBox(){
    var listaImgGaleria = document.getElementsByClassName("imgGal");
    /* console.log(listaImgGaleria); */

    for (var i=0; i<listaImgGaleria.length; i++){
        listaRutaImgGal.push(listaImgGaleria[i].src);
    }

    for (var i=0; i<listaImgGaleria.length; i++){
        listaImgGaleria[i].addEventListener('click', openLightBox);
    }

    function openLightBox(){
        var rutaImgClick = event.currentTarget.src;
        numeroImg = listaRutaImgGal.indexOf(rutaImgClick);

        document.getElementById("imageToShow").innerHTML = "<img class='imageLightBox' src=" + listaRutaImgGal[numeroImg] + ">";
        document.getElementById("modalLightBoxG").style.display = "block";
        document.documentElement.style.overflow = "hidden";
        closeLightBox();
    }

    function closeLightBox(){
        window.addEventListener("click", function(event) {
            if (!event.target.matches(".imageLightBox") && !event.target.matches(".imgGal") && !event.target.matches(".lbButtons") && !event.target.matches(".fa-solid") ){
                document.getElementById("modalLightBoxG").style.display = "none";
                document.documentElement.style.overflowY = "auto";
            }
        });
    }
}

function nextImgGal() {
    numeroImg++;

    if(numeroImg == listaRutaImgGal.length){
        numeroImg = 0;
    }

    document.getElementById("imageToShow").innerHTML = "<img class='imageLightBox' src=" + listaRutaImgGal[numeroImg] + ">";
    /* console.log(numeroImg); */
}

function prevImgGal() {
    numeroImg--;

    if(numeroImg < 0){
        numeroImg = listaRutaImgGal.length-1;
    }

    document.getElementById("imageToShow").innerHTML = "<img class='imageLightBox' src=" + listaRutaImgGal[numeroImg] + ">";
}

/* Aqui empieza el codigo del lightbox de Proximos Lanzamientos */
var listaRutaImgLanz = [];
var numeroImg = 0;

function readyLightBoxLanz(){
    var listaImgLanz = document.getElementsByClassName("imgLanz");

    for (var i=0; i<listaImgLanz.length; i++){
        listaRutaImgLanz.push(listaImgLanz[i].src);
    }

    for (var i=0; i<listaImgLanz.length; i++){
        listaImgLanz[i].addEventListener('click', openLightBox);
    }

    function openLightBox(){
        var rutaImgClick = event.currentTarget.src;
        numeroImg = listaRutaImgLanz.indexOf(rutaImgClick);

        document.getElementById("imageToShowLanz").innerHTML = "<img class='imageLightBoxLanz' src=" + listaRutaImgLanz[numeroImg] + ">";
        document.getElementById("modalLightBoxLanz").style.display = "block";
        document.documentElement.style.overflow = "hidden";
        closeLightBox();
    }

    function closeLightBox(){
        window.addEventListener("click", function(event) {
            if (!event.target.matches(".imageLightBoxLanz") && !event.target.matches(".imgLanz") && !event.target.matches(".lbButtons") && !event.target.matches(".fa-solid") ){
                document.getElementById("modalLightBoxLanz").style.display = "none";
                document.documentElement.style.overflowY = "auto";
            }
        });
    }
}

function nextImgLanz() {
    numeroImg++;

    if(numeroImg == listaRutaImgLanz.length){
        numeroImg = 0;
    }

    document.getElementById("imageToShowLanz").innerHTML = "<img class='imageLightBoxLanz' src=" + listaRutaImgLanz[numeroImg] + ">";
}

function prevImgLanz() {
    numeroImg--;

    if(numeroImg < 0){
        numeroImg = listaRutaImgLanz.length-1;
    }

    document.getElementById("imageToShowLanz").innerHTML = "<img class='imageLightBoxLanz' src=" + listaRutaImgLanz[numeroImg] + ">";
}


/* Aqui esta el modal de Reserva y Compra */
function modalRyC(modalId){
    document.getElementById(modalId).style.display="block";
    document.documentElement.style.overflow="hidden";

    var nombre = document.getElementById("formNombre").value;
    var direccion = document.getElementById("formDireccion").value;
    var correo = document.getElementById("formCorreo").value;
    var mensajeReserva;
    var mensajeCompra;

    (function formCheck(){
        if(!document.getElementById("formNombre").checkValidity()){
            mensajeReserva= "Introduce un nombre correcto.";
            document.getElementById("mensajeReserva").innerHTML = mensajeReserva;

            mensajeCompra= "Introduce un nombre correcto.";
            document.getElementById("mensajeCompra").innerHTML = mensajeCompra;
        }
        else if(!document.getElementById("formDireccion").checkValidity()){
            mensajeReserva= "La dirección no puede estar vacia.";
            document.getElementById("mensajeReserva").innerHTML = mensajeReserva;

            mensajeCompra= "La dirección no puede estar vacia.";
            document.getElementById("mensajeCompra").innerHTML = mensajeCompra;
        }
        else if(!document.getElementById("formCorreo").checkValidity()){
            mensajeReserva= "Correo incorrecto.";
            document.getElementById("mensajeReserva").innerHTML = mensajeReserva;

            mensajeCompra= "Correo incorrecto.";
            document.getElementById("mensajeCompra").innerHTML = mensajeCompra;
        }
        else{
            mensajeReserva= "Apreciado/a " + nombre + ", le confirmamos que se ha realizado la reserva de forma correcta y recibirá un mensaje de confirmación al siguiente correo: " + correo + ".";
            mensajeCompra= "Apreciado/a " + nombre + ", le confirmamos que se ha realizado la compra de forma correcta, el pedido se enviará a la siguiente dirección " + direccion + " y recibirá un mensaje de confirmación al siguiente correo:" + correo + ".";

            document.getElementById("mensajeReserva").innerHTML = mensajeReserva;
            document.getElementById("botonReservaMB").focus();

            document.getElementById("mensajeCompra").innerHTML = mensajeCompra;
            document.getElementById("botonComprarMB").focus();
        }
    })();
}

function cerrarMBRyC(modalId){
    document.getElementById(modalId).style.display="none";
    document.documentElement.style.overflowY="auto";

    document.getElementById("formNombre").value="";
    document.getElementById("formDireccion").value="";
    document.getElementById("formPago").value="";
    document.getElementById("formCorreo").value="";
}

