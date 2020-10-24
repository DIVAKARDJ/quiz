(function($) {

    /*------------------------------------------
        = HIDE PRELOADER
    -------------------------------------------*/
    function pageLoader() {
        if($('.page-loader').length) {
            $('.page-loader').delay(100).fadeOut(500, function() {
            });
        }
    }

    /*------------------------------------------
    = WOW ANIMATION SETTING
    -------------------------------------------*/
    var wow = new WOW({
        boxClass:     'wow',      // default
        animateClass: 'animated', // default
        offset:       0,          // default
        mobile:       true,       // default
        live:         true        // default
    });

    /*================================
    slicknav
    ==================================*/

    $('.main-menu .nav_mobile_menu').slicknav({
        label: '',
        duration: 1000,
        easingOpen: "easeOutBounce", //available with jQuery UI
        prependTo:'.mobile_menu'
     });



    /*==========================================================================
        WHEN WINDOW SCROLL
    ==========================================================================*/
    $(window).on("scroll", function() {
        toggleBackToTopBtn();

    });



    /*==========================================================================
        WHEN DOCUMENT LOADING
    ==========================================================================*/
        $(window).on('load', function() {

            pageLoader();

        });


      //. smooth scrolling
      $(function() {
        $('.main-menu ul li  a ,.main-menu ul.mobile_menu li  a, .scrollup').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 1
            }, 1000, 'easeInOutExpo');
            event.preventDefault();
        });
        $('body').attr('id', 'scrolltop');
    });

     //. smooth scrolling
     $(function() {
        $('.footer-single ul li  a , .scrollup').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 1
            }, 1000, 'easeInOutExpo');
            event.preventDefault();
        });
        $('body').attr('id', 'scrolltop');
    });


    
    // sticky-header
    $(window).scroll(function() {
        activeMenuItem($(".main-menu"));
        if ($(window).scrollTop() > 10) {
            $('.sticky-header').addClass('sticky');
            $('.scrollup').addClass('show_hide');
        } else {
            $('.sticky-header').removeClass('sticky');
            $('.scrollup').removeClass('show_hide');
        }
    });
    /*================================
    2. Scroll Function
    ==================================*/
    $(window).on('scroll', function() {
        activeMenuItem($(".nav_mobile_menu"));
    });



    /*================================
    11. Smoth Scroll
    ==================================*/
    function smoothScrolling($links, $topGap) {
        var links = $links;
        var topGap = $topGap;

        links.on("click", function() {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
                if (target.length) {
                    $("html, body").animate({
                        scrollTop: target.offset().top - topGap
                    }, 1000, "easeInOutExpo");
                    return false;
                }
            }
            return false;
        });
    }

    /*================================
    12. Active current Li
    ==================================*/
    function activeMenuItem($links) {
        var top = $(window).scrollTop(),
            windowHeight = $(window).height(),
            documentHeight = $(document).height(),
            cur_pos = top + 2,
            sections = $("section"),
            nav = $links,
            nav_height = nav.outerHeight(),
            home = nav.find(" > ul > li:first");

        sections.each(function() {
            var top = $(this).offset().top - nav_height - 40,
                bottom = top + $(this).outerHeight();

            if (cur_pos >= top && cur_pos <= bottom) {
                nav.find("> ul > li > a").parent().removeClass("active");
                nav.find("a[href='#" + $(this).attr('id') + "']").parent().addClass("active");
            } else if (cur_pos === 2) {
                nav.find("> ul > li > a").parent().removeClass("active");
                home.addClass("active");
            } else if ($(window).scrollTop() + windowHeight > documentHeight - 400) {
                nav.find("> ul > li > a").parent().removeClass("active");
            }
        });
    }

    /*------------------------------------------
        = BACK TO TOP BTN SETTING
    -------------------------------------------*/
    $("body").append("<a href='#' class='back-to-top'><i class='ti-angle-up'></i></a>");

    function toggleBackToTopBtn() {
        var amountScrolled = 1000;
        if ($(window).scrollTop() > amountScrolled) {
            $("a.back-to-top").fadeIn("slow");
        } else {
            $("a.back-to-top").fadeOut("slow");
        }
    }

    $(".back-to-top").on("click", function() {
        $("html,body").animate({
            scrollTop: 0
        }, 700);
        return false;
    })



})(window.jQuery);
