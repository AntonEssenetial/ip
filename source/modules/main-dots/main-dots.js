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
