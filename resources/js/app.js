import Dropzone from "dropzone";

Dropzone.autoDiscover = false;
const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function(){
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`)

            imagenPublicada.previewElement.classList.add('az-success', 'dz-complete')
        }
    }
})

dropzone.on('sending', function(file, xhr, formData){
    console.log(formData);
})

dropzone.on('success', function(file, response){
    document.querySelector('[name="imagen"]').value = response.imagen
})

dropzone.on('error', function(file, message){
    console.log(message);
})

dropzone.on('removedfile', function(){
    console.log('Archivo eliminado...');
})

dropzone.on('removedfile', function() {
    document.querySelector('[name="imagen"]').value = ''
})