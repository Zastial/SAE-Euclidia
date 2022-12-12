

function changeImage(id) {
    console.log(id);
    $clickedImageSrc = document.getElementById(id).src;
    document.getElementById("main-image").src = $clickedImageSrc
}