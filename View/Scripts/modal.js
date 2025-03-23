document.addEventListener('DOMContentLoaded', function() {
    var imageModal = document.getElementById('imageModal');
    imageModal.addEventListener('show.bs.modal', function (event) {
        var triggerImage = event.relatedTarget;
        var imageSrc = triggerImage.getAttribute('data-bs-image');
        var modalImage = imageModal.querySelector('#modalImage');
        modalImage.src = imageSrc;
    });
});