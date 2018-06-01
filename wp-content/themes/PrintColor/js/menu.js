$(document).ready(function () {

// ------------------------- acc --------

    $(".accordeon > h3").click(function() {
        if (false == $(this).next().is(':visible')) {
            $('.accordeon ul').slideUp(300);
        }
        $(this).next().slideToggle(300);
    });
// ----------end acc-------------------

// -------------отзыв------------------

    $('.new_recall_button').click(function () {
        $('.comment-respond').slideToggle('slow')
    });
// -------------отзыв конец---------------

    $('.menu-glavnoe-menyu-container').append('<div id="menu_left_trigger"></div>'); //Добавляем див. верхнее меню
    $('#menu_left_trigger').click(function() {
        $('#menu-glavnoe-menyu>li').toggle(
            function() {
                $('#menu-glavnoe-menyu>li').hide;
            },
            function() {
                $('#menu-glavnoe-menyu>li').show;
            }
        );
    });

    $('.menu-glavnoe-menyu-container').append('<div id="menu_trigger"></div>'); //Правый сайдбар
    $('#menu_trigger').click(function() {
        $('.pw_right_sidebar').toggle(
            function() {
                $('.pw_right_sidebar').hide;
            },
            function() {
                $('.pw_right_sidebar').show;
            }
        );
    });

    $('.pw_category_holder').append('<div id="menu_button"></div>'); //Левый сайдбар
    $('#menu_button').addClass('arrow_right');
    $('#menu_button').click(function() {
        if ($('#menu_button').hasClass('arrow_right')) {
            $('.pw_category_holder').css('left', '0')
            $('#menu_button').removeClass('arrow_right') && $('#menu_button').addClass('arrow_left');
        } else {
            if ($('#menu_button').hasClass('arrow_left')) {
                $('.pw_category_holder').css('left', '-52%')
                $('#menu_button').removeClass('arrow_left') && $('#menu_button').addClass('arrow_right');
            };
        }
    })



    $(window).scroll(function() {
        if ($(this).scrollTop() > 400) {
                $('.scroll_top').css("opacity", ".8");
            } else if ($(this).scrollTop() <= 400) {
                    $('.scroll_top').css("opacity", "0");
            };
        });


    //scroll
    function scrollToTop() {
        $('.scroll_top[href*=#]').bind("click", function(e) {
            var anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $(anchor.attr('href')).offset().top
            }, 1000);
            e.preventDefault();
        });
        return false;
    }
    scrollToTop();

});