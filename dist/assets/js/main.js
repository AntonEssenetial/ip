'use strict';

// svg4everybody();

$(function() {
	FastClick.attach(document.body);
});

$('.table').basictable({ baseClass: 'table' });

// Modules
// // category-slider
(function() {

    $('.slick__slider').slick({
        infinite: true,
        autoplay: true,
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });

})();

// footer-checkbox
(function() {

    var div = $(".footer__form__check-wrapper");

    $('.form__input_subscibe').click(function(event) {
        div.addClass('active');
    });

    $(document).mouseup(function (e){ 
        if (!div.is(e.target) 
            && div.has(e.target).length === 0) { 
        div.removeClass('active'); 
        };
    });

})();

// // footer-nav
// (function() {

// 	// Your code here

// })();

// footer
(function() {

    $('.footer__up__link').click(function () {
      $('body,html').animate({
          scrollTop: 0
      }, 1000);
      return false;
    });

})();

// gallery
(function() {

    // Lightbox
    function lightBox(lightboxClass) {

        var lightbox = $(lightboxClass);

        lightbox.simpleLightbox();
    }

    lightBox('.gallery__item');
    

})();

// header-search

// // main-dots
(function() {

    // Anchor function
    $(function() {
        $(".main__dots__link").click(function() {
            $('.main__dots__link').removeClass('active');
            $(this).addClass('active');
             event.preventDefault();

            $('html, body').animate({
                scrollTop: $( $.attr(this, 'href') ).offset().top
            }, 500);
        });
    });

})();

// main-menu




// modals
$(function() {
    $('[data-remodal-id]').remodal();
});


// // sandwitch
(function() {

    $('.jsMobileDropdown').click(function(event) {
        var menu = $('.main-menu');
        $(this).toggleClass('active');
        menu.toggleClass('active animated fadeInUp');
    });

})();

