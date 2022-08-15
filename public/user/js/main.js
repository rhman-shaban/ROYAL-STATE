(function($) {

    "use strict";

    //=========MENU FIX JS=========
    
        if($(window).scrollTop()>80){
            $('.wsus__main_menu').addClass('menu_fix');
        }
        $(window).scroll(function() {
            var scrolling = $(this).scrollTop();

            if (scrolling > 80) {
                $('.wsus__main_menu').addClass('menu_fix');
            } else {
                $('.wsus__main_menu').removeClass('menu_fix');
            }
        });
    



    //=======SELECT2======
    $(document).ready(function() {
        $('.select_2').select2();
    });


    //=========COUNTER.JS=========
    $('.counter').countUp();



    //*==========TESTIMONIAL SLIDER=========
    $('.testi_slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: false,

        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false,
                }
            }
        ]
    });



    //*==========SCROLL BUTTON==========
    $('.wsus__scroll_btn').on('click', function() {
        $('html, body').animate({
            scrollTop: 0,
        }, 200);
    });

    $(window).on('scroll', function() {
        var scrolling = $(this).scrollTop();

        if (scrolling > 300) {
            $('.wsus__scroll_btn').fadeIn();
        } else {
            $('.wsus__scroll_btn').fadeOut();
        }
    });



    //*======PROPERTY DETAILS=======
    $('.pro_details_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        dots: true,
        arrows: false,
    });



    //*======PRODUCT VIDEO========
    $('.venobox').venobox();


    //=======NICE NUMBER======
    $('input[type="number"]').niceNumber();


    //=======imageuploadify js======
    $(document).ready(function() {
        $('input[type="file"]').imageuploadify();
    })




    //*==========DASHBOARD MENU==========

    $('.wsus__menu_icon').on('click', function() {
        $('.wsus__dashboard_side_bar').addClass('.menu_show');
    });


    $('.wsus__close_icon').on('click', function() {
        $('.wsus__dashboard_side_bar').removeClass('.menu_show');
    });



    $('.wsus__menu_icon').on('click', function() {
        $('.wsus__close_icon').addClass('.show_close_icon');
    });

    $('.wsus__close_icon').on('click', function() {
        $('.wsus__close_icon').removeClass('.show_close_icon');
    });



    
    //*==========SMALL DEVICE PROPERTY FILTER==========  
    $('.wsus__filter_icon').on('click', function(){
        $('.minus_2').toggleClass('.icon_roatet');
    });
        
    $('.wsus__filter_icon').on('click', function(){
        $('.wsus__filter_body').toggleClass('.show_filter');
    });
    


})(jQuery);