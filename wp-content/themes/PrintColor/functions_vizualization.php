<?php
    /*НАШЕ ПИСЬМО*/
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: PrintColor <'. $admin_email .'>' . "\r\n" .
                'Reply-To: '. $fio . ' <' . $email . '>' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
    $message  =  '<b>Заказ на визуализацию (ФОТООБОИ):</b>' . '<br /><br />';
    $message .=  'Клиент: ' . $_POST["username"] . '<br />';
    $message .=  'Телефон: ' . $_POST["phone"] . '<br />';
    $message .=  'Город: ' . $_POST["usercity"] . '<br />';
    $message .=  'E-mail: ' . $_POST["mail"] . '<br />';
    $message .=  'Комментарий: ' . $_POST["info"] . '<br />';
    $message .=  '<br /><hr /><br />';
    $message .=  'Изображение: <a href="http://oboi-printcolor.com/wp-content/uploads/filebase/uImages/'.$_FILES['filename']['name'].'">Изображение пользователя</a><br/>';
    mail('printcolor45@gmail.com', 'Заказ на визуализацию - фотообои ('. $_POST["username"] .')', $message, $headers);
    mail('printcolor-45@yandex.ru', 'Заказ на визуализацию - фотообои ('. $_POST["username"] .')', $message, $headers);

    /*ПИСЬМО КЛИЕНТУ*/
    $headers2  = 'MIME-Version: 1.0' . "\r\n";
    $headers2 .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers2 .= 'From: PrintColor <'. $admin_email .'>' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();
    $message2  =  '<h2>Спасибо за ваш заказ!</h2>' . '<br /><br />';
    $message2 .=  '<b>Наш дизайнер посмотрит изображения и свяжется с вами.</b>' . '<br /><br />';
    $message2 .=  '<b>Детали заказа:</b>' . '<br /><br />';
    $message2 .=  'Ваше имя: ' . $_POST["username"] . '<br />';
    $message2 .=  'Телефон: ' . $_POST["phone"] . '<br />';
    $message2 .=  'Город: ' . $_POST["usercity"] . '<br />';
    $message2 .=  'E-mail: ' . $_POST["mail"] . '<br />';
    $message2 .=  'Ваш комментарий: ' . $_POST["info"] . '<br />';
    $message2 .=  '<br /><hr /><br />';
    $message2 .=  'Изображение: <a href="http://oboi-printcolor.com/wp-content/uploads/filebase/uImages/'.$_FILES['filename']['name'].'">Изображение пользователя</a><br/>';
    mail( $_POST["mail"], 'Заказ на визуализацию - фотообои PrintColor', $message2, $headers2);
    echo "Спасибо Ваша заявка принята, в ближайшее время наши менеджеры свяжутся с вами";
?>