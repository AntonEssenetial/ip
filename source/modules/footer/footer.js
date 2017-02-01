// footer
(function() {

    $('.footer__up__link').click(function () {
      $('body,html').animate({
          scrollTop: 0
      }, 1000);
      return false;
    });

})();
