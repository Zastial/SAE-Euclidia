$( function() {
    $( "#sortable" ).sortable({
        animation: 150,
        handle: '.img-container',

        onSort: function (evt) {
            $('li span').each(function(index, element) {
                $(this).text(index+1);
            });
        }
    });
});

var fileBuffer = new Set();

// number of images uploaded, used to link images in the page to the images in fileBuffer
var imageCounter = 0;

$(function() {

    // when uploading new images
    $('#image-upload').on('change', function() {
        if (this.files) {
            // add new images while updating imageCounter
            for (i = 0; i < this.files.length; i++) {
                appendImage(this.files[i], imageCounter);
                this.files[i].id = imageCounter;
                fileBuffer.add(this.files[i]);
                imageCounter++;
            }
            $('li span').each(function(index, element) {
                $(this).text(index+1);
            });
        }
    });

    $('#submit-new-product-button').click(function(){
        if ($('#image-upload')[0].files.length == 0) Notiflix.Notify.failure("Vous n'avez pas sélectionné d'images !", {timeout:5000, distance:'90px', width:"400px", fontSize:"16px"});
        if ($('#model-upload')[0].files.length == 0) Notiflix.Notify.failure("Vous n'avez pas sélectionné de modèle !", {timeout:5000, distance:'90px', width:"400px", fontSize:"16px"});
    })

    //when uploading models
    $('#model-upload').on('change', function(){
        $('#list-of-models').empty();
        if (this.files){
            for (i = 0; i < this.files.length; i++) {
                if (i!=0)$('#list-of-models').append(" / ");else $('#list-of-models').append("<strong>Fichiers sélectionnés: </strong>");
                $('#list-of-models').append(this.files[i]['name']);

            }
        }
    })

    $("form").submit(function(e) {
        e.preventDefault();    

        // update images in file upload
        let list = new DataTransfer();
        $('.img-container').each(function() {
            order = $(this).attr('data-id');
            for (let image of fileBuffer) {
                if (image.id == order) {
                    list.items.add(image);
                    break;
                }
            }
        });
        $('#image-upload').prop('files', list.files);
        var fd = new FormData($('form')[0]);
        console.log(fd);
        // ajax call
        $.ajax({
            url: base_url + "admin/addProductAjax/", 
            type: "POST",
            data: fd,
            cache:false,
            async: false,
            processData:false,
            contentType:false,
            success: 
                function(data){
                    console.log(data);
                    var parsedData = JSON.parse(data);
                    console.log(parsedData);
                    if (parsedData.length != 2) {
                        Notiflix.Notify.failure('Une erreur est survenue, veuillez réessayer.', {timeout:5000, distance:'90px', width:"400px", fontSize:"16px"});
                        return;
                    }

                    if (parsedData[1] == "success") {
                        window.location.href = base_url+"admin/products";
                    }

                    var errors = parsedData[0];

                    if ('image' in errors && errors['image'].length>0) {
                        errors['image'].forEach(element => {
                            $("li:nth-of-type("+(element+1)+")").addClass("invalid-image");
                            $("li:nth-of-type("+(element+1)+") .img-container").prepend('<img class="error-icon" src="'+base_url+'assets/icon/icon-error.svg" />');
                        });
                        Notiflix.Notify.failure('Certaines images sont invalides !', {timeout:5000, distance:'90px', width:"400px", fontSize:"16px"});
                    }

                    if ('zip' in errors) {
                        Notiflix.Notify.failure('Certains Modèles 3D sont invalides !', {timeout:5000, distance:'90px', width:"400px", fontSize:"16px"});
                        var text = $('#list-of-models').html();
                        console.log(text);
                        errors['zip'].forEach(element => {
                            text = text.replace(element, '<span style="color:red">'+element+'</span>');
                            console.log(element, '<span style="color:red">'+element+'</span>', text.includes(element));
                        });
                        console.log(text);
                        $('#list-of-models').empty();
                        $('#list-of-models').append(text);
                    }
                }
        });
    });

});

// add a new image 
function appendImage(image, index) {
    if (image) {

        var imageBalise = "image-"+index
        $('#sortable').append(
            $('<li/>', {class: imageBalise}).append(
                $('<div/>', {class: "img-container", "data-id": index}).append(
                    $('<span/>').append(
                        index+1
                    )
                )
            ).append(
                $('<div/>', {class: "link-delete", onclick: 'removeImage('+index+')'}).append(
                    $('<img/>', {src: base_url+"assets/icon/icon-delete.svg", alt: "supprimer"})
                )
            )
        )
        
        var reader = new FileReader();
        // add image src when reader is ready
        reader.onload = function(event) {
            
            $('.'+imageBalise+' .img-container').append(
                $('<img/>', {src: event.target.result})
            )
        }
        reader.readAsDataURL(image);
    }
}

// remove image from the array and page of id index
function removeImage(index) {
    console.log(fileBuffer);
    for (let image of fileBuffer.values()) {
       if (image.id == index) {
        fileBuffer.delete(image);
        $('.image-'+index).remove();
       }
    }

    $('li span').each(function(index, element) {
        $(this).text(index+1);
    });
}
