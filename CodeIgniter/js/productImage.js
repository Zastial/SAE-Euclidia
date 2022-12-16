$( function() {
    $( "#sortable" ).sortable({
        animation: 150,
        handle: '.infos'
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

    // when submitting the form, we change the order of the images in the input of type file
    $('form').on('submit', function (e) {
        let list = new DataTransfer();
        $('.infos').each(function() {
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
        console.log(list);
        return true;
    });

});

// add a new image 
function appendImage(image, index) {
    if (image) {

        var imageBalise = "image-"+index
        $('#sortable').append(
            $('<li/>', {class: imageBalise}).append(
                $('<div/>', {class: "infos", "data-id": index})
            ).append(
                $('<div/>', {class: "link-delete", onclick: 'removeImage('+index+')'}).append(
                    $('<img/>', {src: base_url+"assets/icon/icon-delete.svg", alt: "supprimer"})
                )
            )
        )
        
        var reader = new FileReader();
        // add image src when reader is ready
        reader.onload = function(event) {
            
            $('.'+imageBalise+' .infos').append(
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
