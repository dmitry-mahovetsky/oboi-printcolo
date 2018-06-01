jQuery(document).ready(function($) {

// img options
    function imgTechnology (argument) {

        $('#resetFilter').on('click', function () {
            $('.img_opt').prop("checked", false);
            $("#selected-image")
                .removeClass('flip')
                .removeClass('sepia')
                .removeClass('greyscale')
        });

        $('.img_opt').prop("checked", false);

        $("#mirror_opt").change(function() {
            $("#selected-image").toggleClass('flip');
        });

        $("#bw_opt").change(function() {
            $("#selected-image").toggleClass('greyscale');
            $("#selected-image").removeClass('sepia');
            $("#sepia_opt").prop("checked",false);
        });
        $("#sepia_opt").change(function() {
            $("#selected-image").toggleClass('sepia');
            $("#selected-image").removeClass('greyscale');
            $("#bw_opt").prop("checked",false);
        });
    }
    imgTechnology();


	// function materialOptions () {
	// 	$("#paper_mat").prop("checked", true);
	// 	$("#glanec").prop("checked", true);
	// 	$("#vinil_holder input").prop("checked", false);
	// 	$("#flizelin_holder input").prop("checked", false);
	// 	$("#paper_mat").change(function() {
	// 		$("#paper_holder").slideDown(400);
	// 		$("#flizelin_holder").slideUp(400) && $("#vinil_holder").slideUp(400);
	// 		$("#glanec").prop("checked", true) && $("#aqua").prop("checked", false) && $("#venetia").prop("checked", false);
	// 	});
	// 	$("#flizelin_mat").change(function() {
	// 		$("#flizelin_holder").slideDown(400);
	// 		$("#paper_holder").slideUp(400) && $("#vinil_holder").slideUp(400);
	// 		$("#glanec").prop("checked", false) && $("#aqua").prop("checked", true) && $("#venetia").prop("checked", false);
	// 	});
	// 	$("#vinil_mat").change(function() {
	// 		$("#vinil_holder").slideDown(400);
	// 		$("#paper_holder").slideUp(400) && $("#flizelin_holder").slideUp(400);
	// 		$("#glanec").prop("checked", false) && $("#aqua").prop("checked", false) && $("#venetia").prop("checked", true);
	// 	});
	// }
	// materialOptions();



// ------------------------- acc --------
    function acc_delivery (argument) {
        $(".accordeon > h3").click(function() {
            if (false == $(this).next().is(':visible')) {
                $('.accordeon ul').slideUp(300);
            }
            $(this).next().slideToggle(300);
        });
    }
    acc_delivery();
// ----------end acc-------------------


// -------------отзыв------------------
    function comment (argument) {
        $('.new_recall_button').click(function () {
            $('.comment-respond').slideToggle('slow')
        });
    }
    comment();
// -------------отзыв конец---------------


    function menu_trigger (argument) {
        $('.menu-glavnoe-menyu-container').append('<div id="menu_left_trigger"></div>'); //Добавляем див. верхнее меню
        $('#menu_left_trigger').click(function() {
            $('#menu-glavnoe-menyu>li').slideToggle();
        });
        $(document).on('click', function(e) {
            if ((!$(e.target).closest(".menu-glavnoe-menyu-container").length)&($(window).width())<=768) {
                $('#menu-glavnoe-menyu>li').hide();
            }
            e.stopPropagation();
        });
    }
    menu_trigger();


    function trigger_category (argument) {
        $('.open_catalog').click(function() {
            $('.open_catalog i').toggleClass('fa-toggle-on');
            $('.open_catalog').toggleClass('green_color');
            $('.pw_category_holder').slideToggle({
            step: function() {
                if ($(this).css('display') == 'block') {
                    $(this).css('display', 'flex');
                }
            },
            complete: function() {
                if ($(this).css('display') == 'block') {
                    $(this).css('display', 'flex');
                }
            }
        });
        });
        $(document).on('click', function(e) {
            if (((!$(e.target).closest(".open_catalog").length)&(!$(e.target).closest(".pw_category_holder").length))&($(window).width())<=768) {
                $('.pw_category_holder').hide();
                $('.open_catalog i').removeClass('fa-toggle-on');
                $('.open_catalog').removeClass('green_color');
            }
            e.stopPropagation();
        });
    }
    trigger_category();



    var $menu = jQuery(".menu-glavnoe-menyu-container"),
        menuOffset = $menu.parent().offset();

    //scroll
    $(window).scroll(function() {
        var scrollTop = $(this).scrollTop();
        if (scrollTop > 400) {
            $('.scroll_top').css("opacity", ".8");
        } else {
            $('.scroll_top').css("opacity", "0");
        }

        if (scrollTop > menuOffset.top) {
            $menu.addClass("fixed");
            $('.nav_menu_hidden').css('height', $menu[0].clientHeight + 20).removeClass('hidden');
        } else {
            $('.nav_menu_hidden').css('height', '0').addClass('hidden');
            $menu.removeClass("fixed");
        }
    })();


    $('.scroll_top[href*=#]').bind("click", function(e) {
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top
        }, 1000);
        e.preventDefault();
    });

function call_back() {
    $('.button_call_back').click(function() {
        $('.popup_parent_call_back').fadeIn(300);
        $('.popup_window_call_back').fadeIn(300);
    });
    $('.popup_close_call_back').click(function() {
        $('.popup_parent_call_back').fadeOut(300);
    });
    $(document).on('click', function(e) {
        if ((!$(e.target).closest(".popup_window_call_back").length)&(!$(e.target).closest(".button_call_back").length)) {
            $('.popup_parent_call_back').fadeOut(300);
        }
        e.stopPropagation();
    });
}
call_back();

   $("#call_back_input").mask("+38(999) 999-9999");
   $("#user_phone").mask("+38(999) 999-9999");

function main_order() {
    var winx;
    var winy;
    winx = document.body.scrollWidth;
    winy = document.body.scrollHeight;
    $('.popup_parent').css("height", winy);

    $('.popup_close,.popup_parent').click(function() {
        $('.popup_parent').fadeOut(1000);
        $('.popup_window').fadeOut(1000);
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

    var app = {
         
        initialize : function () {
            this.setUpListeners();
        },
 
        setUpListeners: function () {
            $('#order_page').on('submit', app.submitForm);
            $('#order_page').on('keydown', 'input', app.removeError);
        },
 
        submitForm: function (e) {
            e.preventDefault();
            
            var form = $(this),
                submitBtn = form.find('button[type="submit"]');

            if( app.validateForm(form) === false ) return false;

            submitBtn.attr('disabled', 'disabled');

            var str = form.serialize();

            $.ajax({
                type: "POST",
                url: "/wp-content/themes/PrintColor/functions_order.php",
                data: str,
                success: function(html) {
                    showform(html);
                },
                error: function(xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            });
        },

        validateForm: function (form){
            var inputs = form.find('#user_phone, #user_name'),
                valid = true;

            inputs.tooltip('destroy');

            $.each(inputs, function(index, val) {
                var input = $(val),
                    val = input.val(),
                    formGroup = input.parents('.form-group'),
                    label = formGroup.find('label').text().toLowerCase(),
                    textError = 'Введите ' + label;

                if(val.length === 0){
                    formGroup.addClass('has-error').removeClass('has-success');
                    input.tooltip({
                        trigger: 'manual',
                        placement: 'right',
                        title: textError
                    }).tooltip('show');
                    valid = false;
                }else{
                    formGroup.addClass('has-success').removeClass('has-error');
                }
            });

            return valid;
        },

        removeError: function () {
            $(this).tooltip('destroy').parents('.form-group').removeClass('has-error');
        }
    }

    app.initialize();
 
}
main_order();

    // Все, что выше - от разработчиков темы.
    // Сергей Сенокосов

    // Отправка пользовательского изображения

    var $sendImageForm = $('#send-image-form'),
        $alertSuccess = $('.message-success', $sendImageForm),
        $alertError = $('.message-error', $sendImageForm),
        $dropText = $('#drop-text'),
        $dropZone = $('#drop-zone'),
        $imageInput = $('#user-image'),
        userImage;
    
    $sendImageForm.on('click', '.button-upload', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $imageInput.click();
    });
    
    $imageInput.on('change', function(e) {
        
        dropChangeHandler(e);
    });

    $dropZone.on('dragover', function (e) {
        e.preventDefault()
        e = e.originalEvent
        e.dataTransfer.dropEffect = 'copy'
    })
    .on('drop', dropChangeHandler);
    
    $sendImageForm.submit(function(e) {
        e.preventDefault();
        
        var formData = new FormData();
        
        formData.append('image', userImage);
        formData.append('name', $('#user-name').val());
        formData.append('contact', $('#user-contact').val());
        formData.append('comment', $('#user-comment').val());
        formData.append('action', 'send_image');
        
        $.ajax({
            type: "POST",
            url: window.wp_data.ajax_url,
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(json) {
                if (json.status) {
                    $alertError.html('');
                    $dropZone.html('');
                    $alertSuccess.html(json.message + '<br>Загрузить еще<br>изображение');
                } else {
                    $alertError.html(json.message);
                }
            },
            error: function(xhr, str) {
                alert('Error: ' + xhr.responseCode);
            }
        });
    });
    
    // Toggle cities menu
    
    $('#nav-cities-toggle-button').on('click', function(e) {
        e.preventDefault();
        $('.menu-goroda-container').toggle();
    });
    
    // Functions
    
    function updateResults(img, data) {
        var content;
        
        if (!(img.src || img instanceof HTMLCanvasElement)) {
            content = $('<span>Loading image file failed</span>')
        } else {
            content = img;
        }
        
        $dropZone.before($alertError);
        $dropText.remove();
        $alertSuccess.html('');
        $alertError.html('');
        
        $dropZone.html(content);
    }
    
    function displayImage(options) {
        if (!loadImage(
            userImage,
            updateResults,
            options
        )) {
            $dropZone.html(
                '<span>' +
                'Your browser does not support the URL or FileReader API.' +
                '</span>'
            );
        }
    }

    function dropChangeHandler(e) {
        e.preventDefault();
        
        e = e.originalEvent;
        
        var target = e.dataTransfer || e.target,
            options = {
                maxWidth: $dropZone.width(),
                maxHeight: 250,
//                 canvas: true,
//                 pixelRatio: window.devicePixelRatio,
//                 downsamplingRatio: 0.5,
                orientation: true
            };
        
        userImage = target && target.files && target.files[0];
        
        if (!userImage) {
            return;
        }
        
        displayImage(options);
    }

});