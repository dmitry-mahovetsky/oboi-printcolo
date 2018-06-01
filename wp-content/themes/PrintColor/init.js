window.addEventListener('DOMContentLoaded', function (e) {

    $('.data-fancybox').fancybox({
        toolbar  : false,
        smallBtn : true
    });

    var selector = document.querySelector('#selector select');
    var selector2 = document.querySelector('#selector2 select');


    var symbol = 'грн';

    if (selector || selector2) {

        //следим за всеми движениями при каком либо выборе на странице single.php или карточке заказа

        Results = (function () {

            var s1 = function (i) {
                this.one = i;
            };

            var s2 = function (i) {
                this.two = i;
            };


            var result = function () {
                var one = 0;
                var two = 0;
                $('.breakLine').remove();
                if (this.one !== undefined && this.two !== undefined) {
                    one = this.one;
                    two = this.two;
                }


                var $material = document.querySelectorAll('#selector option')[one];
                var $textura = document.querySelectorAll('#selector2 option')[two];

                var width_wallpaper = parseInt($material.getAttribute('data-width'));

                var img = document.getElementById("selected-image");
                var widthW = parseInt(Math.round(img.naturalWidth / 2).toFixed(0)) / 100;
                var heightH = parseInt(Math.round(img.naturalHeight / 2).toFixed(0)) / 100;

                var itemWidth = $("#itemW");

                $sq_width = itemWidth.val() / 100;
                $sq_height = $("#itemH").val() / 100;

                var area_of_square;
                var number_of_wallpapers;

                if ($sq_width === 0) {
                    area_of_square = heightH * widthW;
                    number_of_wallpapers = img.naturalWidth / 2 / width_wallpaper;
                } else {
                    area_of_square = $sq_width * $sq_height;
                    number_of_wallpapers = parseInt(itemWidth.val()) / width_wallpaper;

                }

                function isCorrectFloat(s) {
                    return /^([0-9]+)\./.test(s);
                }

                var number_of_rolls;
                if (isCorrectFloat(number_of_wallpapers)) {
                    number_of_rolls = parseInt(number_of_wallpapers.toString().match(/^([0-9]+)/)[0]) + 1;
                } else {
                    number_of_rolls = parseInt(number_of_wallpapers.toString().match(/^([0-9]+)/)[0])
                }

                document.querySelector('#number_of_rolls').innerHTML = number_of_rolls + ' шт';
                document.querySelector('#numberWallpapers').value = number_of_rolls;

                $line = number_of_rolls;

                if ($sq_width !== 0) {
                    //режим картинку по каличеству рулонов
                    var imgareaselect = document.querySelector('.imgareaselect-selection');
                    var border = imgareaselect.parentNode;
                    border.classList.add('itemsChange');
                    var w = border.clientWidth / $line;
                    for (var q = 0; q < $line; q++) {
                        var div = document.createElement('div');
                        div.className = 'breakLine';
                        div.style.cssText = "width:" + w + "px;";
                        $('.itemsChange').prepend(div);
                    }
                    if ($('#showBreakLine').prop('checked')) {
                        $('.breakLine').removeClass('hidden');
                    } else {
                        $('.breakLine').addClass('hidden');
                    }
                }


                var typeCard = $('.typeCard .fieldGroup input');

                var resultChecked = {};

                for (var i = 0; i < typeCard.length; i++) {
                    if (typeCard[i].checked === true) {
                        resultChecked.value = typeCard[i].value;
                        resultChecked.title = typeCard[i].getAttribute('data-type')
                    } else {
                        typeCard[i].checked = false;
                    }
                }

                $('#typePhoto').val(resultChecked.title);


                var priseTextura = parseInt($textura.getAttribute('data-price'));


                $price_result = priseTextura * parseFloat(resultChecked.value) * area_of_square;

                $('#areaInp').val(area_of_square);
                $('#material').val($material.innerText);
                $('#vinil_type').val($textura.innerText);

                if (area_of_square.toString().length > 4) {
                    area_of_square = area_of_square.toString().substring(0, 4)
                }

                $('#area_of_square').html(area_of_square);
                $('#price').val(Math.round($price_result).toFixed(0));
                $('.resultPrice').html('<b>' + Math.round($price_result).toFixed(0) + '</b>' + symbol);
            };


            return {
                s1: function (i) {
                    s1(i);
                },
                s2: function (i) {
                    s2(i);
                },
                result: function () {
                    return result();
                }
            }

        }());


        itemH.addEventListener('input', function (e) {
            Results.result();
        });

        itemW.addEventListener('input', function (e) {
            Results.result();
        });


        $('.rowBreakCheck').on('change', function () {
            if ($('#showBreakLine').prop('checked')) {
                $('.breakLine').toggleClass('hidden');
            } else {
                $('.breakLine').toggleClass('hidden');
            }
        });

        var fieldGroup = $('.fieldGroup .psevdoCircle');

        for (var i = 0; i < fieldGroup.length; i++) {
            fieldGroup[i].parentNode.addEventListener('click', function (e) {
                e.stopPropagation();

                var index = $(this).find('.psevdoCircle').attr('data-index');

                changeTextOptions(parseInt(index));

                Results.result();


            });
        }


        var Transfer = (function () {

            var typeCard = $('.typeCard .fieldGroup input');


            var obg = {};

            function change() {
                for (var i = 0; i < typeCard.length; i++) {
                    if (typeCard[i].checked === true) {
                        obg.check = typeCard[i].value;
                        obg.it = typeCard[i];
                    }
                }
            }

            function result() {
                return obg;
            }

            return {
                checks: function () {
                    change();
                    return parseFloat(obg.check);
                },
                change: function () {
                    change()
                },
                result: function () {
                    return result()
                }
            }
        })();

        function changeTextOptions(obg) {
            event.stopPropagation();
            var typeCard = $('.typeCard .fieldGroup input');
            Transfer.change();
            var course = typeCard[obg].value;
            var s = document.querySelector('#selector2');
            var option = s.querySelectorAll('select option');
            var a_option = s.querySelector('.active .price');
            var i_option = s.querySelectorAll('.listOption .price');
            var i = parseInt(a_option.getAttribute('data-option'));
            for ( var o = 0, cnd = option.length; o < cnd; o++ ) {
                i_option[o].innerHTML = "<span class=\"number\">" + (parseFloat(option[o].getAttribute('data-price').replace(",", ".")) * course).toFixed(0) + "</span> " +
                    "<span>грн/м2</span>";
            }
            a_option.innerHTML = "<span class=\"number\">" + (parseFloat(option[i].getAttribute('data-price').replace(",", ".")) * course).toFixed(0) + "</span> " +
                "<span>грн/м2</span>";
        }


        //выбор материала
        function materialSelector() {
            if (!document.querySelectorAll('#selector.materialSelector').length) {
                return;
            }
            var selector = document.querySelector('#selector.materialSelector');

            function createActiveOption() {
                var option = selector.querySelectorAll('option');
                var active = document.createElement('div');
                active.className = 'active';
                for (var i = 0; i < option.length; i++) {
                    if (option[i].selected) {

                        var parent = parseInt(option[i].getAttribute('data-id'));
                        var priceThe = document.createElement('div');
                        priceThe.className = 'price';
                        active.innerHTML = option[i].innerHTML;

                        Results.s1(i);
                        active.appendChild(priceThe);
                        changeOptions(parent);
                    }
                }
                selector.appendChild(active);
            }

            createActiveOption();


            function createListOptions() {
                var option = selector.querySelectorAll('option');
                var listOption = document.createElement('div');
                listOption.className = 'listOption';
                for (var i = 0; i < option.length; i++) {
                    var optionElem = document.createElement('div');
                    optionElem.className = 'li';
                    optionElem.setAttribute('data-index', i);
                    var priceThe = document.createElement('div');
                    priceThe.className = 'price';
                    optionElem.innerHTML = option[i].innerHTML;
                    optionElem.appendChild(priceThe);
                    listOption.appendChild(optionElem);
                }
                selector.appendChild(listOption)
            }

            createListOptions();


            function workSelector() {
                selector.onclick = function () {
                    if (!selector.hasAttribute('data-open')) {
                        selector.setAttribute('data-open', 'true');
                    }
                    else {
                        selector.removeAttribute('data-open');
                        Results.result();
                    }
                };
                var option = selector.querySelectorAll('.li');
                for (var i = option.length - 1; i >= 0; i--) {
                    option[i].onclick = function () {
                        var index = this.getAttribute('data-index');
                        selector.querySelectorAll('option')[index].selected = true;
                        selector.removeChild(selector.querySelector('.active'));
                        createActiveOption();

                    }
                }
            }

            workSelector();
        }

        materialSelector();


        //выбор текстуры
        function changeOptions(obg) {
            selector2.innerHTML = "";
            if (document.querySelector('#selector2 .active')) {
                document.querySelector('#selector2 .active').remove();
                document.querySelector('#selector2 .listOption').remove();
            }
            for (var key in $typeWallpaper) {
                if ($typeWallpaper[key].parent === obg) {
                    var o1 = document.createElement('option');
                    o1.setAttribute('data-price', $typeWallpaper[key].price);
                    if ($typeWallpaper[key].img !== null) {
                        o1.setAttribute('data-bg', $typeWallpaper[key].img.url);
                    }
                    o1.innerHTML = $typeWallpaper[key].name;
                    selector2.appendChild(o1)
                }
            }
            materialSelectorZ();
        }

        function materialSelectorZ() {
            if (!document.querySelectorAll('#selector2.texturaSelector').length) {
                return;
            }
            var selector = document.querySelector('#selector2.texturaSelector');

            function createActiveOption() {
                var option = selector.querySelectorAll('option');
                var active = document.createElement('div');
                active.className = 'active';
                for (var i = 0; i < option.length; i++) {
                    if (option[i].selected) {
                        active.innerHTML = option[i].innerHTML;
                        var priceThe = document.createElement('div');
                        priceThe.className = 'price';
                        priceThe.innerHTML = "<span class='number'>" +
                            (parseFloat(option[i].getAttribute('data-price').replace(",", ".")) * Transfer.checks()).toFixed(0) + "</span>" +
                            " " + '<span>' + symbol + '/м2</span>';
                        priceThe.setAttribute('data-option', i);
                        active.appendChild(priceThe);
                        selector.style.backgroundImage = 'url(' + selector.querySelectorAll('option')[i].getAttribute('data-bg') + ')';
                        Results.s2(i);

                    }
                }
                selector.appendChild(active);
            }

            createActiveOption();

            function createListOptions() {
                var option = selector.querySelectorAll('option');
                var listOption = document.createElement('div');
                listOption.className = 'listOption';
                for (var i = 0; i < option.length; i++) {
                    var optionElem = document.createElement('div');
                    optionElem.className = 'li';
                    optionElem.setAttribute('data-index', i);
                    optionElem.innerHTML = option[i].innerHTML;
                    var priceThe = document.createElement('div');
                    priceThe.className = 'price';
                    priceThe.innerHTML = "<span class='number'>" +
                        (parseFloat(option[i].getAttribute('data-price').replace(",", ".")) * Transfer.checks()).toFixed(0) + "</span>" +
                        " " + '<span>' + symbol + '/м2</span>';
                    priceThe.setAttribute('data-option', i);
                    optionElem.appendChild(priceThe);

                    optionElem.setAttribute('data-bg', selector.querySelectorAll('option')[i].getAttribute('data-bg'));
                    if(selector.querySelectorAll('option')[i].getAttribute('data-bg') !== undefined){
                        optionElem.style.backgroundImage = 'url(' + selector.querySelectorAll('option')[i].getAttribute('data-bg') + ')';
                    }
                    listOption.appendChild(optionElem);
                }
                selector.appendChild(listOption)
            }

            createListOptions();

            function workSelector() {
                selector.onclick = function () {
                    if (!selector.hasAttribute('data-open')) {
                        selector.setAttribute('data-open', 'true');
                    }
                    else {
                        selector.removeAttribute('data-open');
                        Results.result();
                    }
                };
                var option = selector.querySelectorAll('.li');
                for (var i = 0; i < option.length; i++) {
                    option[i].onclick = function () {
                        var index = this.getAttribute('data-index');
                        selector.querySelectorAll('option')[index].selected = true;
                        selector.removeChild(selector.querySelector('.active'));
                        createActiveOption();

                    }
                }
            }

            workSelector();
        }

        Results.result();

    }


});
