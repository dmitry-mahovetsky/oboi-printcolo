<?php
/*НАШЕ ПИСЬМО*/
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: PrintColor <'. $admin_email .'>' . "\r\n" .
    'Reply-To: '. $fio . ' <' . $email . '>' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$message  =  '<b>ПЕРЕЗВОНИТЕ МНЕ ПОЖАЛУЙСТА (ФОТООБОИ):</b>' . '<br /><br />';
$message .=  'Телефон: ' . $_POST["phone"] . '<br />';
mail('printcolor45@gmail.com', 'Заказ обратного звонка ('. $_POST["phone"] .')', $message, $headers);
mail('printcolor-45@yandex.ru', 'Заказ обратного звонка ('. $_POST["phone"] .')', $message, $headers);
echo "Спасибо Ваша заявка принята, в ближайшее время наши менеджеры свяжутся с вами";
?>