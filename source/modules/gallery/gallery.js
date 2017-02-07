// gallery
(function() {

    // Lightbox
    function lightBox(lightboxClass) {

        var lightbox = $(lightboxClass);

        lightbox.simpleLightbox();
    }

    lightBox('.gallery__item');
    

})();
