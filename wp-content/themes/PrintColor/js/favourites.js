jQuery(document).ready(function($) {

    var $product = $('.product_item.mosaicflow__item.grid-item'),
        $selectedImg = $('.selectedSelector .row'),
        $btnDel = $('.selectedSelector .btnLink'),
        $lightbox = $('.lightbox');

    $product.hover(
        function() {
            $( this ).addClass('hover');
        }, function() {
            $( this ).removeClass('hover');
        }
    );

    $lightbox.hover(
        function() {
            $( this ).addClass('hover');
        }, function() {
            $( this ).removeClass('hover');
        }
    );

    $selectedImg.hover(
        function() {
            $( this ).addClass('selectedHover');

            var $del = $('.selectedHover .del');


            $del.on('click', function (e) {
                e.stopPropagation();
                e.stopImmediatePropagation();

                $('.del').removeClass('delete_true');

                var $t = $(this);
                $t.addClass('delete_true');
                var d = document.querySelectorAll('.del');
                var r;
                for ( var i = 0; i < d.length; i++ ){
                    if(d[i].classList.contains('delete_true')){
                        r = i;
                    }
                }

                $.ajax({
                    type: "POST",
                    url: "/wp-content/themes/PrintColor/session/delete_session.php",
                    data: "user_ip="+window.wp_user_id.ajax_user+"&delete_one="+r,
                    response: 'text',
                    success: function(data) {
                        console.log(data);
                    }
                });

                $t[0].parentNode.remove();
                if($('.del').length === 0){
                    $('.selectedSelector').addClass('hidden')
                }
            });

        }, function() {
            $( this ).removeClass('selectedHover');
        }
    );

    function template(arr) {
        return '<div class="card">' +
            '<a href="' + arr.link + '" title="Перейти">' +
            '<img src="' + arr.img + '" alt="">' +
            '</a>' +
            '<a class="del" title="Удалить">' +
            '<img src="/wp-content/themes/PrintColor/img/icons/delete.png" alt="">' +
            '</a>' +
            '</div>';
    }

    function isertFavourites(obg, e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        //console.log('true');
        $.ajax({
            type: "POST",
            url: "/wp-content/themes/PrintColor/session/insert_session.php",
            data: "user_ip="+window.wp_user_id.ajax_user+"&img="+obg.img+"&link="+obg.link,
            response: 'text',
            success: function(data) {
                console.log(data)
            }
        });

    }

    $('.like', $product).on('click', function (e) {
        e.preventDefault();


        var $select = $('.selectedSelector');

        if($select.hasClass('hidden')){
            $select.removeClass('hidden')
        }
        var $t = $(this),
            $parent = $(".product_item.mosaicflow__item.grid-item.hover").parent($t).prevObject,
            $obg = {};

        $obg.img = $('.product_img', $parent).attr('href');
        $obg.link = $('.readMore', $parent).attr('href');

        isertFavourites($obg, e);


        $selectedImg.append(template($obg));

    });


    $('.like', $lightbox).on('click', function (e) {
        e.preventDefault();

        var $select = $('.selectedSelector');

        if($select.hasClass('hidden')){
            $select.removeClass('hidden')
        }
        var $t = $(this),
            $parent = $(".lightbox.hover").parent($t).prevObject,
            $obg = {};

        $obg.img = $('.lb-image', $parent).attr('src');
        $obg.link = $('.button.order_button', $parent).attr('href');

        isertFavourites($obg, e);

        $selectedImg.append(template($obg));

    });


    $btnDel.on('click', function (e) {
        $('.selectedSelector .row .card').remove();
        $('.selectedSelector').addClass('hidden');

        $.ajax({
            type: "POST",
            url: "/wp-content/themes/PrintColor/session/delete_session.php",
            data: "user_ip="+window.wp_user_id.ajax_user+"&delete_all="+1,
            response: 'text',
            success: function(data) {
                console.log(data);
            }
        });
    });


});