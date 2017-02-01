'use strict';

// svg4everybody();

$(function() {
	FastClick.attach(document.body);
});

$('.table').basictable({ baseClass: 'table' });

// Modules
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

// header-search

// // main-dots
(function() {

    // Anchor function
    $(function() {
        $(".main__dots__link").click(function() {
            $('.main__dots__link').removeClass('active');
            $(this).addClass('active');
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });

})();

// main-menu




// modals
$(function() {
    $('[data-remodal-id]').remodal();
});


