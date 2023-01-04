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
    $('#file-upload').on('change', function() {
        if (this.files) {
            // add new images while updating imageCounter
            for (i = 0; i < this.files.length; i++) {
                appendImage(this.files[i], imageCounter);
                this.files[i].id = imageCounter;
                fileBuffer.add(this.files[i]);
                imageCounter++;
            }
        }
    });

    $("form").submit(function(e) {
        e.preventDefault();    

        // update images in file upload
        let list = new DataTransfer();
        $('.img-container').each(function() {
            order = $(this).attr('data-id');
            for (let image of fileBuffer) {
                if (image.id == order) {
                    list.items.add(image);
                    fileBuffer.delete(image);
                    break;
                }
            }
        });
        $('#file-upload').prop('files', list.files);
        var fd = new FormData($('form')[0]);
        // ajax call
        $.ajax({
            type: "POST",
            url: base_url + "/admin/addProductAjax", 
            data: fd,
            cache:false,
            processData:false,
            contentType:false,
            success: 
                function(data){
                    alert(data);  //as a debugging message.
                    console.log(data);
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
}
