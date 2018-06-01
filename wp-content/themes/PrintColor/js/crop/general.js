
// jQuery(function($) {
    window.addEventListener('DOMContentLoaded', function (e) {
    // Используем $(window).load т.к. при $(document).ready() скрипт иногда срабатывает до полной загрузки рисунка
    // Смотри http://stackoverflow.com/questions/544993/official-way-to-ask-jquery-wait-for-all-images-to-load-before-executing-somethin

    $('.main-image').waitForImages(function() {
        // Ждем, пока загрузится рисунок
        new_price();
        cropSize();


            window.addEventListener('DOMContentLoaded', function (e) {
                Results.result();
            });

    });



    function new_price(){

            var img_w = document.getElementById("selected-image").naturalWidth;
            var img_h = document.getElementById("selected-image").naturalHeight; 
                var widthCM = Math.round(img_w / 2);
                var heightCM = Math.round(img_h / 2);
                    widthCM.toFixed(0);
                    heightCM.toFixed(0);
                        $('.max-size-width').val(widthCM);
                        $('.max-size-height').val(heightCM);


// загрузка скриптов по событиям, для изменения цены
    }


    function cropSize(){
        var $inputWidth = $('#itemW'),
            $inputHeight = $('#itemH'),
            inputWidthValue = $('.max-size-width').val(),
            inputHeightValue = $('.max-size-height').val(),
            $wallPaper = $('#selected-image'),
            wallPaperWidth = $wallPaper.width(),
            wallPaperHeight = $wallPaper.height(),
            currentCoordx2 = wallPaperWidth,
            currentCoordy2 = wallPaperHeight,
            cropDimensionsInput = $('#crop_dimentions');
        var maxRealWidth = +parseInt(inputWidthValue, 10) || 0;
        var maxRealHeigh = +parseInt(inputHeightValue, 10) || 0;


        // Последние значения selection zone
        var lastSelection = new Object();
        lastSelection.height = 0;
        lastSelection.width = 0;

        // получаем коэффициент ширины
        var factorW = wallPaperWidth/maxRealWidth;
        var factorH = wallPaperHeight/maxRealHeigh;

        $inputWidth.val(maxRealWidth);
        $inputHeight.val(maxRealHeigh);

        // подключаем API нашего кропа для оперирования данными позиции выбранной области
        // Запрещаем разрушение рамки из-за клика за пределами рамки выбора
        var ias = $('.texture-box').imgAreaSelect({
            instance: true,
            persistent: true,
            handles: true,
            minWidth: parseInt(wallPaperWidth/10),
            minHeight: parseInt(wallPaperHeight/10)
        });

        // создаем начальную позицию выбранного кропа = всё изображение
        //ias.setSelection(0, 0, wallPaperWidth, wallPaperHeight, true);
        setSelection(0, 0, wallPaperWidth, wallPaperHeight);
        ias.setOptions({ show: true });
        ias.update();

        /// При выставлении новой области выбора запоминаются значения старого выбора
        function setSelection(x1, y1, x2, y2)
        {
            lastSelection.width = x2 - x1;
            lastSelection.height = y2 - y1;
            ias.setSelection(x1, y1, x2, y2, true);
        }

        //передаем начальные значения в инпут cropDimensionsInput
        //setFormPostSizes(0, Math.round(currentCoordx2/factorW), Math.round(currentCoordy2/factorH), 0)
        setFormPostSizes(0, 0, 0, 0);
        //var CoordsValue = 0+' | '+0+' | '+Math.round(currentCoordx2/factorW)+' | '+Math.round(currentCoordx2/factorW);

        function rescale(ratioX, ratioY, width, height){
            var ratio = height / width;
            var realRatio = maxRealHeigh / maxRealWidth;
            if ( ratioX > ratioY )
            {
                // Поменялась ширина
                var newWidth = (1/ratio) * wallPaperHeight;

                ias.setOptions({minWidth: Math.round(newWidth / 10), minHeight: wallPaperHeight});
                // Выставляем selection по середине
                var dstX = parseInt((wallPaperWidth - newWidth ) / 2 );
                setSelection(dstX, 0, newWidth + dstX, wallPaperHeight)

                var newMaxRealWidth = (1/realRatio) * height;
                var dstXReal = parseInt((newMaxRealWidth - width ) / 2 );

                //setFormPostSizes(100, (newMaxRealWidth - (dstXReal + width))/newMaxRealWidth, 100, dstXReal/newMaxRealWidth)
                setFormPostSizes(0, (wallPaperWidth - (newWidth + dstX))/wallPaperWidth, 0, dstX/wallPaperWidth)
                //CoordsValue = dstXReal+' | '+0+' | '+(width+dstXReal)+' | '+height;

            }
            else
            {
                // Поменялась высота
                var newHeight = ratio * wallPaperWidth;

                ias.setOptions({minWidth: wallPaperWidth, minHeight: Math.round(newHeight / 10)});
                // Выставляем selection по середине
                var dstY = parseInt((wallPaperHeight - newHeight ) / 2 );
                setSelection(0, dstY, wallPaperWidth, newHeight + dstY);

                var newMaxRealHeight = realRatio * width;
                var dstYReal = parseInt((newMaxRealHeight - height ) / 2 );

                //setFormPostSizes(dstYReal/newMaxRealHeight, 100, (newMaxRealHeight - (dstYReal + height))/newMaxRealHeight, 100)
                setFormPostSizes(dstY/wallPaperHeight, 0, (wallPaperHeight - (newHeight + dstY))/wallPaperHeight, 0)
                //CoordsValue = 0+' | '+dstYReal+' | '+width+' | '+(height + dstYReal);
            }

            ias.update();
        }

        /// Метод принимает соотношения размеров рамки к максимальным для рисунка и записыват для метода POST
        function setFormPostSizes(top, right, bottom, left)
        {
            top = +(top*100).toFixed(2);
            right = +(right*100).toFixed(2);
            bottom = +(bottom*100).toFixed(2);
            left = +(left*100).toFixed(2);

            // Исправляем ошибки округления
            if (bottom > 100 || bottom == 0)
                bottom = 100;
            if (right > 100 || right == 0)
                right = 100;
            if (top > 100 || top == 0)
                top = 100;
            if (left > 100 || left == 0)
                left = 100;
            var vals = top+' | '+right+' | '+bottom+' | '+left;
            cropDimensionsInput.val(vals);
            $('#sys-crop-size').text(vals);
        }

        //Изменяем кроп при вводе ширины в инпуте
        $inputWidth.keyup(function(event){
            var width = +parseInt($inputWidth.val(), 10) || 0,
                height = +parseInt($inputHeight.val(), 10) || 0;
            if (width < parseInt(maxRealWidth / 10)) {
                $inputWidth.val(width);
                return false;
            }
            if (width > 999)
                width = 999;

            $inputWidth.val(width);

            rescale(wallPaperWidth / width, wallPaperHeight / height, width, height);
            Results.result();
        });

        $inputWidth.focusout(function (){
            var width = +parseInt($inputWidth.val(), 10) || 0,
                height = +parseInt($inputHeight.val(), 10) || 0;
            if (width < parseInt(maxRealWidth / 10)) {
                $inputWidth.val(maxRealWidth);
                $inputWidth.keyup();
            }
        });
        
        //Изменяем кроп при вводе высоты в инпуте
       $inputHeight.keyup(function(event){
            var width = +parseInt($inputWidth.val(), 10) || 0,
                height = +parseInt($inputHeight.val(), 10) || 0;
            if (height < parseInt(maxRealHeigh / 10)) {
                $inputHeight.val(height);
                return false;
            }
            if (height > 999)
                height = 999;

            $inputHeight.val(height);

            rescale(wallPaperWidth / width, wallPaperHeight / height, width, height);
           Results.result();
        });
        
        $inputHeight.focusout(function (){
            var height = +parseInt($inputHeight.val(), 10) || 0;
            if (height < parseInt(maxRealHeigh / 10)) {
                $inputHeight.val(maxRealHeigh);
                $inputHeight.keyup();
            }
        });




        $('.texture-box').imgAreaSelect({
            onSelectEnd: function (img, selection) {
                // Если пользователь потянул за угол, то автоматически ставим нужную зону выбора
                if (Math.round(selection.width) < parseInt(wallPaperWidth) && selection.height < parseInt(wallPaperHeight))
                {
                    if (Math.round(selection.width) > Math.round(selection.height))
                    {
                        ias.setOptions({minWidth: wallPaperWidth, minHeight: parseInt(wallPaperHeight/10) });
                        ias.setSelection(0, selection.y1, wallPaperWidth, selection.y2, true);
                        selection.width = wallPaperWidth;
                    }
                    else
                    {
                        ias.setOptions({minWidth: parseInt(wallPaperWidth/10), minHeight: wallPaperHeight});
                        ias.setSelection(selection.x1, 0, selection.x2, wallPaperHeight, true);
                        selection.height = wallPaperHeight;
                    }
                    ias.update();
                }


                var ratio = selection.height / selection.width;
                var realRatio = maxRealHeigh / maxRealWidth;
                var newHeight = +parseInt($inputHeight.val(), 10) || 0;
                var newWidth = +parseInt($inputWidth.val(), 10) || 0;

                var maxNewHeight = newHeight;
                var maxNewWidth = newWidth;

                var newXCoordReal = 0;
                var newYCoordReal = 0;

                // Блокируем изменение высоты, при изменении ширины и наоборот
                if (Math.round(selection.width) < parseInt(wallPaperWidth)) {
                    ias.setOptions({minWidth: parseInt(wallPaperWidth/10), minHeight: wallPaperHeight});
                    newWidth = Math.round((1/ratio) * newHeight);
                    maxNewWidth = Math.round((1/realRatio) * newHeight);
                    // Проблему округления решаем проверкой в пределах 1 пикселя
                    // if (newWidth - 1 >= maxRealWidth || newWidth + 1 >= maxRealWidth)
                    //     newWidth = maxRealWidth;

                    newXCoordReal = selection.x1 * (newWidth / selection.width);
                    newYCoordReal = 0;
                }
                else if (Math.round(selection.height) < parseInt(wallPaperHeight)) {
                    ias.setOptions({minWidth: wallPaperWidth, minHeight: parseInt(wallPaperHeight/10) });
                    newHeight = Math.round(ratio * newWidth);
                    maxNewHeight = Math.round(realRatio * newWidth);
                    // Проблему округления решаем проверкой в пределах 1 пикселя
                    // if (newHeight - 1 >= maxRealHeigh || newHeight + 1 >= maxRealHeigh)
                    //     newHeight = maxRealHeigh;
                    newXCoordReal = 0;
                    newYCoordReal = selection.y1 * (newHeight / selection.height);
                }
                else {
                    // Смотрим, какая сторона изменилась
                    if (selection.width != lastSelection.width)
                    {
                        ias.setOptions({minWidth: parseInt(wallPaperWidth/10), minHeight: wallPaperHeight});
                        setSelection(selection.x1, 0, selection.x2, wallPaperHeight);

                        newWidth = Math.round((1/ratio) * newHeight);
                        maxNewWidth = Math.round((1/realRatio) * newHeight);
                        // Проблему округления решаем проверкой в пределах 1 пикселя
                        // if (newWidth - 1 >= maxRealWidth || newWidth + 1 >= maxRealWidth)
                        //     newWidth = maxRealWidth;
                        newXCoordReal = selection.x1 * (newWidth / selection.width);
                        newYCoordReal = 0;
                    }
                    else if (selection.height != lastSelection.height)
                    {
                        ias.setOptions({minWidth: wallPaperWidth, minHeight: parseInt(wallPaperHeight/10) });
                        setSelection(0, selection.y1, wallPaperWidth, selection.y2);

                        newHeight = Math.round(ratio * newWidth);
                        maxNewHeight = Math.round(realRatio * newWidth);
                        // Проблему округления решаем проверкой в пределах 1 пикселя
                        // if (newHeight - 1 >= maxRealHeigh || newHeight + 1 >= maxRealHeigh)
                        //     newHeight = maxRealHeigh;
                        newXCoordReal = 0;
                        newYCoordReal = selection.y1 * (newHeight / selection.height);
                    }
                    else
                    {
                        // Ничего не изменилось
                        ias.setOptions({minWidth: parseInt(wallPaperWidth/10), minHeight: parseInt(wallPaperHeight/10) });
                    }

                    if (selection.width == wallPaperWidth && selection.height == wallPaperHeight)
                    {
                        ias.setOptions({minWidth: parseInt(wallPaperWidth/10), minHeight: parseInt(wallPaperHeight/10) });
                    }
                }
                ias.update();
                $inputWidth.val(newWidth);
                $inputHeight.val(newHeight);

                // Записываем старое значение зоны выбора
                lastSelection.width = selection.width;
                lastSelection.height = selection.height;

                // Записываем реальные координаты для отправки
                //CoordsValue = Math.round(newXCoordReal)+' | '+Math.round(newYCoordReal)+' | '+Math.round(newXCoordReal + newWidth)+' | '+Math.round(newYCoordReal + newHeight);

                //setFormPostSizes(newYCoordReal/maxNewHeight, (maxNewWidth - (newXCoordReal + newWidth))/maxNewWidth, (maxNewHeight - (newYCoordReal + newHeight))/maxNewHeight, newXCoordReal/maxNewWidth);
                setFormPostSizes(selection.y1/wallPaperHeight, (wallPaperWidth - (selection.x1 + selection.width))/wallPaperWidth, (wallPaperHeight - (selection.y1 + selection.height))/wallPaperHeight, selection.x1/wallPaperWidth);
              Results.result();
            }

        });
        ias.setOptions({ show: true });

        ias.update();


    };
});
