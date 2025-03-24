document.addEventListener('DOMContentLoaded', function() {
    var imageModal = document.getElementById('imageModal');
    imageModal.addEventListener('show.bs.modal', function (event) {
        // Obtiene el botón que abrió el modal
        var button = event.relatedTarget;
        // Obtiene el atributo que contiene la imagen
        var imageSrc = button.getAttribute('data-bs-image');
        // Asigna el src del modal
        var modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
    });
});