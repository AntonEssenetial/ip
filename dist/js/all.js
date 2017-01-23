$(document).ready(function() {


    // Youtube iframe popup
    $(function() {
        $(".jsVideoPopup").jqueryVideoLightning({
            id: "tJ_FWn65uqg",
            autoplay: true,
            color: "white"
        });
    });
  

    // Active tabs
    function swtch(tab, tabActive, tabContent, parentDiv){

        var jsTab = $(tab),
            jsTabActive = tabActive,
            jsParent = $(parentDiv),
            jsContent = $(tabContent);

        jsTab.click(function() {
            $(this).closest(jsParent).find(jsTab).removeClass(jsTabActive).eq($(this).index()).addClass(jsTabActive);
            $(this).closest(jsParent).find(jsContent).removeClass(jsTabActive).eq($(this).index()).addClass(jsTabActive);
        }).eq(0);

    }
    swtch('.jsTab', 'jsActive', '.jsCont', '.jsParent');

  
    // Toggle class function
    function jsToggle (button) {

        var activeClass = 'jsActive',
            jsToggleButton = $(button);

        jsToggleButton.click(function(event) {
            $(this).toggleClass(activeClass);

        });

    }
    // jsToggle();


    // Navgoco acordion
    function navGoco(acordion) {
        var jsAcordion = $(acordion);
        jsAcordion.navgoco({accordion: true});
    }
    // function navGoco('.jsAcordion');


    // Lightgallery
    // $().lightGallery(); 


    // Bx slider
    var slider1 = $('jsBxSlider-0').bxSlider({
        pager: true,
        controls: false,
        auto: true,
        speed: 1000,
        pause: 5000,
        mode: 'fade',
        pagerCustom: '.jsBxPager',
        responsive: true,
        // nextSelector: '.bx-next',
        // prevSelector: '.bx-prev',
        // nextText: '↽',
        // prevText: '↽'
    });


    // Bx custom controls 
    // $('#next').click(function(){
    //   slider1.goToNextSlide();
    //   slider2.goToPrevSlide();
    //   return false
    // });
    // $('#prev').click(function(){
    //   slider1.goToPrevSlide();
    //   slider2.goToNextSlide();
    //   return false
    // });


    // Slick slider
    $('.jsSlick-0').slick({
      infinite: true,
      dots: false,
      arrows: false,
      autoplay: false,
      slidesToShow: 15,
      slidesToScroll: 9
    });


    // Slick slider
    $('.jsSlick-1').slick({
        infinite: true,
        dots: false,
        arrows: true,
        autoplay: false,
        slidesToShow: 11,
        // slidesToScroll: 11,
        draggable: false,
        lazyLoad: 'ondemand',
        focusOnSelect: true,
        centerMode: true,
        variableWidth: true,
        nextArrow: '.slick-next',
        prevArrow: '.slick-prev',
        responsive: [
            {
                breakpoint: 1250,
                settings: {
                    slidesToShow: 7,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                    settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });


    // Reenit slick
    // $().click(function(event) {
    //   $().slick("setPosition");
    // });


    // Scroll to top
    $('jsToTop').click(function () {
      $('body,html').animate({
          scrollTop: 0
      }, 1000);
      return false;
    });


    // Height detect funciton
    function heightDetect(){
        $().css( 
            'height', $(window).height()
        );
    }
    // heightDetect();


    // Width detect funciton
    function widthDetect(){
        $().css( 
            'width', $(window).width()
        );
    }
    // widthDetect();


    // Toggle menu
    $('.jsMobileDropdown').click(function(event) {
        var menu = $('.main-menu');
        $(this).toggleClass('jsActive');
        menu.toggleClass('jsActive animated fadeInUp');
    });


    // Custom scroll
    var scrollers = [
        {
            element:$('.dialog__scroll'),
            params:{
                scrollInertia:100,
                autoExpandScrollbar: true
            },
            options:{
                type:'width',
                value: 1024
            }
        },
        {
            element:$('.table-scroll'),
            params:{
                scrollInertia:100,
                axis:"x",
                setWidth: false,
                setHeight: false,
                autoExpandScrollbar: true,
                contentTouchScroll: false
            },
            options:{
                type:'width',
                value:650      
            }
        }
    ];

    
    // Initialize each available scroll element
    $.each(scrollers, function(key, value){
        if(value.element.length){   
            value = value.element.mCustomScrollbar(value.params);     
        }
        else delete scrollers[key];  
    });
    

    function adjustScroll(){
      
        var windowWidth = $(window).width(),
            windowHeight = $(window).height();
      
        // compact array by value
        scrollers = scrollers.filter(function(scroll){
            return scroll !== undefined;
        });  
      
        // adjust scroll visibility by window width or height
        $.each(scrollers, function(key, scroll){
        
            var windowPart = (scroll.options.type == 'width') ? windowWidth : windowHeight;
        
            // turn scroll ON
            if(windowPart >= scroll.options.value){
                scroll.element.mCustomScrollbar('update').removeClass('overflow');          
            }      
            // turn scroll OFF
            else {
                scroll.element.mCustomScrollbar('disable', true).addClass('overflow');     
            }     
        
        windowPart = null;
                      
      });
      
    }
    

    // Auto height column function
    equalheight = function(container){

        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = new Array([]),
            $el,
            topPosition = 0;
        $(container).each(function() {
        
            $el = $(this);
            $($el).height('auto');
            topPostion = $el.position().top;
        
            if (currentRowStart != topPostion) {
                for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }

            rowDivs.length = 0; // empty the array
            currentRowStart = topPostion;
            currentTallest = $el.height();
            rowDivs.push($el);

            } else {
                rowDivs.push($el);
                currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
            }

            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
        });
    };
  

    // Anchor function
    $(function() {
        $(".jsAnchor").click(function() {
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


    // Lightbox
    function lightBox(prop) {
        var lightbox = prop.simpleLightbox({
            captions: false,
            showCounter: false,
            nav: false
        });
    }
    // lightBox($('.jsLightBox'));


    // Lang selector
    $('.jsLangSelector').click(function(){
        $(this).toggleClass('jsActive');
        $('.header__lang__selector').toggleClass('jsVisible');
    });


    // Window onload onresize 
    $(window).load(function() {
        // equalheight();
        // heightDetect();
        // widthDetect();
        setTimeout(function(){
            adjustScroll();     
        }, 10);        
    });
    
    $(window).resize(function() { 
        // equalheight(); 
        // heightDetect();
        // widthDetect();        
        adjustScroll();   
    });

});
