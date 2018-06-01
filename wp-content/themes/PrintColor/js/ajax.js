jQuery(document).ready(function($) {
    var winx;
    var winy;
    winx = document.body.scrollWidth;
    winy = document.body.scrollHeight;
    $('.popup_parent').css("height", winy);

    $('.popup_close,.popup_parent,.closf').click(function() {
        $('.popup_parent').fadeOut(1000);
        $('.popup_window').fadeOut(1000);
    });
});

function showform(x) {
    $("#preload").css("display", "none");
    $('.popup_parent').fadeIn(1000);
    $('.popup_window').fadeIn(1000);
    newtxt = x;
    h = $(window).scrollTop();
    w = $('.popup_window').width();
    $('.popup_window').css("display", "block");
    $('#textform').text(newtxt);
}

$(document).ready(function() {



    // $("#order_page").submit(function() {
    //     $('.popup_parent').fadeIn(1000);
    //     $('.popup_window').css("display", "none");
    //     $("#preload").css("display", "block");
    //     var form_id = $(this);
    //     var str = $(this).serialize();
    //     $.ajax({
    //         type: "POST",
    //         url: "/wp-content/themes/PrintColor/functions_order.php",
    //         data: str,
    //         success: function(html) {
    //             showform(html);
    //         },
    //         error: function(xhr, str) {
    //             alert('Возникла ошибка: ' + xhr.responseCode);
    //         }
    //     });
    //     return false;
    // });

    $("#call_back").submit(function() {
        $('.popup_parent').fadeIn(1000);
        $('.popup_window').css("display", "none");
        $('.popup_parent_call_back').fadeOut(300);
        $('.popup_window_call_back').fadeOut(300);
        $("#preload").css("display", "block");
        var form_id = $(this);
        var str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/wp-content/themes/PrintColor/functions_call_back.php",
            data: str,
            success: function(html) {
                showform(html);
            },
            error: function(xhr, str) {
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
        return false;
    });

    $("#request_form").submit(function() {
        $('.popup_parent').fadeIn(1000);
        $('.popup_window').css("display", "none");
        $("#preload").css("display", "block");
        var form_id = $(this);
        var str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/wp-content/themes/PrintColor/functions_request.php",
            data: str,
            success: function(html) {
                showform(html);
            },
            error: function(xhr, str) {
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
        return false;
    });




    $("#express_form").submit(function() {
        $('.popup_parent').fadeIn(1000);
        $('.popup_window').css("display", "none");
        $("#preload").css("display", "block");
        var form_id = $(this);
        var str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/wp-content/themes/PrintColor/functions_express.php",
            data: str,
            success: function(html) {
                showform(html);
            },
            error: function(xhr, str) {
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
        return false;
    });


    $("#vizualization_form").submit(function() {
        $('.popup_parent').fadeIn(1000);
        $('.popup_window').css("display", "none");
        $("#preload").css("display", "block");
        var form_id = $(this);
        var str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/wp-content/themes/PrintColor/functions_vizualization.php",
            data: str,
            success: function(html) {
                showform(html);
            },
            error: function(xhr, str) {
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
        return false;
    });

});