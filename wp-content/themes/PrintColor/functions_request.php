<?php

    if($_POST["hidden"]){
        $message  =  '<b>НОВАЯ ЗАЯВКА НА СОТРУДНИЧЕСТВО:</b>' . '<br /><br />';
        $subject = 'Заявка на сотрудничество ('. $_POST["username"] .')';
        $subject2 = 'Ваша заявка на сотрудничество PrintColor';
    } else {
        $message  =  '<b>НОВАЯ ЗАЯВКА НА ПОИСК ИЗОБРАЖЕНИЯ (ФОТООБОИ):</b>' . '<br /><br />';
        $subject = 'Заявка на поиск ('. $_POST["username"] .')';
        $subject2 = 'Ваша заявка на поиск изображения PrintColor';
    }

    /*НАШЕ ПИСЬМО*/
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: PrintColor <'. $admin_email .'>' . "\r\n" .
                'Reply-To: '. $fio . ' <' . $email . '>' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

    $message .=  'Клиент: ' . $_POST["username"] . '<br />';
    $message .=  'Телефон: ' . $_POST["phone"] . '<br />';
    $message .=  'E-mail: ' . $_POST["mail"] . '<br />';
    $message .=  'Город: ' . $_POST["usercity"] . '<br />';
    $message .=  'Комментарий: ' . $_POST["info"] . '<br />';
    mail('printcolor45@gmail.com', $subject, $message, $headers);
    mail('printcolor-45@yandex.ru', $subject, $message, $headers);

    /*ПИСЬМО КЛИЕНТУ*/
    $headers2  = 'MIME-Version: 1.0' . "\r\n";
    $headers2 .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers2 .= 'From: PrintColor <'. $admin_email .'>' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();
    $message2  =  '<h2>Спасибо за Вашу заявку!</h2>' . '<br /><br />';
    $message2 .=  '<b>Наш менеджер свяжется с Вами в ближайшее время для уточнения деталей.</b>' . '<br /><br />';
    $message2 .=  'Ваше имя: ' . $_POST["username"] . '<br />';
    $message2 .=  'Телефон: ' . $_POST["phone"] . '<br />';
    $message2 .=  'E-mail: ' . $_POST["mail"] . '<br />';
    $message2 .=  'Город: ' . $_POST["usercity"] . '<br />';
    $message2 .=  'Ваш комментарий: ' . $_POST["info"] . '<br />';
    mail( $_POST["mail"], $subject2, $message2, $headers2);
    echo "Спасибо Ваша заявка принята, в ближайшее время наши менеджеры свяжутся с вами";
?>