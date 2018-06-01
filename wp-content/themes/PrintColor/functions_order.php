<?php 
// -------------------------------------Обработка заказов--------------------------------------------

// Основная форма заказа
if($_POST["mirror"] == 'mirror_yes'){
        $mirror_send = 'ДА';
    } else {
        $mirror_send = 'НЕТ';
    };
    if($_POST["bw"] == 'bw_yes'){
        $bw_send = 'ДА';
    } else { 
        $bw_send = 'НЕТ';
    };
    if($_POST["sepia"] == 'sepia_yes') {
        $sepia_send = 'ДА';
    } else {
        $sepia_send = 'НЕТ';
    };
    if($_POST["paper_type"] == 'glanec_yes') {
        $texture = 'Глянец';
    };
    if($_POST["flizelin_type"] == 'aqua_yes') {
        $texture = 'Аква';
    };


    $material = $_POST["material"];
    $texture = $_POST["vinil_type"];


//    switch($_POST["material"]){
//        case 'paper_yes': $material = 'Бумага'; break;
//        case 'flizelin_yes': $material = 'Флизелин'; break;
//        case 'vinil_yes': $material = 'Винил'; break;
//    }
//    switch($_POST["vinil_type"]){
//        case 'venetia_yes': $texture = 'Венецианская штукатурка'; break;
//        case 'krujevo_yes': $texture = 'Кружево'; break;
//        case 'decor_yes': $texture = 'Декоративная штукатурка'; break;
//        // case 'losk_yes': $texture = 'Лоск'; break;
//        case 'jivopis_yes': $texture = 'Живопись'; break;
//        case 'melkij_len_yes': $texture = 'Мелкий лен'; break;
//        case 'inej_yes': $texture = 'Иней'; break;
//        case 'pesok_yes': $texture = 'Песок'; break;
//        case 'kamen_yes': $texture = 'Камень'; break;
//        case 'pil_yes': $texture = 'Пыль'; break;
//        case 'koja_yes': $texture = 'Кожа'; break;
//        case 'solomka_yes': $texture = 'Соломка'; break;
//        case 'kora_yes': $texture = 'Кора'; break;
//        case 'freska_yes': $texture = 'Фреска'; break;
//        case 'korzina_yes': $texture = 'Корзинное плетение'; break;
//        case 'holst_yes': $texture = 'Холст'; break;
//    }



    $crop_dimentions = $_POST['crop_dimentions'];
    /*НАШЕ ПИСЬМО*/
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: PrintColor <'. $admin_email .'>' . "\r\n" .
                'Reply-To: '. $fio . ' <' . $email . '>' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
    $message  =  '<b>НОВЫЙ ЗАКАЗ (ФОТООБОИ):</b>' . '<br /><br />';
    $message .=  'Клиент: ' . $_POST["user_name"] . '<br />';
    $message .=  'Телефон: ' . $_POST["user_phone"] . '<br />';
//    $message .=  'Город: ' . $_POST["user_city"] . '<br />';
    $message .=  'E-mail: ' . $_POST["user_mail"] . '<br />';
    $message .=  'Комментарий: ' . $_POST["user_comments"] . '<br />';
    $message .=  '<br /><hr /><br />';
    $message .=  'Изображение: <a href="//'.$_SERVER['SERVER_NAME'].$_POST["selimg"].'"> № '.$_POST["imgid"].' '.$_POST["imgtitle"].'</a><br/>';
    $message .=  'Ширина обоев: ' . $_POST["itemW"] . '<br />';
    $message .=  'Высота обоев: ' . $_POST["itemH"] . '<br />';
    $message .=  'Площадь: ' . $_POST["area"] . '<br />';
    $message .=  'Количество рулонов: ' . $_POST["numberWallpapers"] . '<br />';
    $message .=  'Кроп: ' . $crop_dimentions . '<br />';
    $message .=  'Тип фотообоев: ' . $_POST["typePhoto"] . '<br />';
    $message .=  'Отзеркаливание: ' . $mirror_send . '<br/>';
    $message .=  'Черно-белое: ' . $bw_send . '<br/>';
    $message .=  'Сепия: ' . $sepia_send . '<br/>';
    $message .=  'Материал: ' . $material . '<br/>';
    $message .=  'Текстура: ' . $texture . '<br/>';
    // $message .=  'Тип печати: ' . $printtype . '<br/>';
    $message .=  'Цена: ' . $_POST["price"] . '<br />';
    mail('printcolor45@gmail.com', 'Заказ на фотообои ('. $_POST["user_name"] .')', $message, $headers);
    mail('printcolor-45@yandex.ru', 'Заказ на фотообои ('. $_POST["user_name"] .')', $message, $headers);

    /*ПИСЬМО КЛИЕНТУ*/
    $headers2  = 'MIME-Version: 1.0' . "\r\n";
    $headers2 .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers2 .= 'From: PrintColor <'. $admin_email .'>' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();
    $message2  =  '<h2>Спасибо за ваш заказ!</h2>' . '<br /><br />';
    $message2 .=  '<b>Наш менеджер свяжется с вами в ближайшее время для подтверждения заказа.</b>' . '<br /><br />';
    $message2 .=  '<b>Детали заказа:</b>' . '<br /><br />';
    $message2 .=  'Ваше имя: ' . $_POST["user_name"] . '<br />';
    $message2 .=  'Телефон: ' . $_POST["user_phone"] . '<br />';
//    $message2 .=  'Город: ' . $_POST["user_city"] . '<br />';
    $message2 .=  'E-mail: ' . $_POST["user_mail"] . '<br />';
    $message2 .=  'Ваш комментарий: ' . $_POST["user_comments"] . '<br />';
    $message2 .=  '<br /><hr /><br />';
    $message2 .=  '<a href="//'.$_SERVER['SERVER_NAME'].$_POST["selimg"].'">Выбранное изображение</a><br/>';
    $message2 .=  'Ширина обоев: ' . $_POST["itemW"] . '<br />';
    $message2 .=  'Высота обоев: ' . $_POST["itemH"] . '<br />';
    $message2 .=  'Площадь: ' . $_POST["area"] . '<br />';
    $message2 .=  'Количество рулонов: ' . $_POST["numberWallpapers"] . '<br />';
    $message2 .=  'Кроп: ' . $crop_dimentions . '<br />';
    $message2 .=  'Тип фотообоев: ' . $_POST["typePhoto"] . '<br />';
    $message2 .=  'Материал: ' . $material . '<br/>';
    $message2 .=  'Текстура: ' . $texture . '<br/>';
    $message2 .=  'Отзеркаливание: ' . $mirror_send . '<br/>';
    $message2 .=  'Черно-белое: ' . $bw_send . '<br/>';
    $message2 .=  'Сепия: ' . $sepia_send . '<br/>';
    // $message2 .=  'Тип печати: ' . $printtype . '<br/>';
    $message2 .=  'Цена: ' . $_POST["price"] . '<br />';
    mail( $_POST["user_mail"], 'Ваш заказ - фотообои PrintColor', $message2, $headers2);
   // header('Location: http://foto-oboi/spasibo-zakaz');
   // echo "Спасибо Ваша заявка принята, в ближайшее время наши менеджеры свяжутся с вами";
?>