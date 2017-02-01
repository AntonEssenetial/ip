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
