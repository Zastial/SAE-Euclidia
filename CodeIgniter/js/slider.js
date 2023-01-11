
/**
 * Fonction pour changer l'image principale affichée sur la page des produits.
 * @param {int} id l'id de l'image sur laquelle on a cliqué
 */
function changeImage(id) {
    
    clickedImage = document.getElementById(id);

    clickedImageSrc = clickedImage.src;
    document.getElementById("main-image").src = clickedImageSrc;

}



/**
 * Fonctions pour changer le scrolling de la liste des images quand on clique sur les boutons
 */
function scrollSliderLeft() {
    document.getElementById('slider-image').scrollLeft -= 300;
}

function scrollSliderRight() {
    document.getElementById('slider-image').scrollLeft += 300;
}



