

function changeImage(id) {
    
    clickedImage = document.getElementById(id);

    clickedImageSrc = clickedImage.src;
    document.getElementById("main-image").src = clickedImageSrc;

}




function scrollSliderLeft() {
    document.getElementById('slider-image').scrollLeft -= 300;
}

function scrollSliderRight() {
    document.getElementById('slider-image').scrollLeft += 300;
}



