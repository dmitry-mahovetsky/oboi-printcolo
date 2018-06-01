<?php

session_start();

if($_POST["user_ip"]){


        if(count($_SESSION['data']) == 0){
            $_SESSION['data'][$_POST["user_ip"]] = array(
                "img" =>array($_POST["img"]),
                "link" =>array($_POST["link"]),
            );
        } else {
            if (array_key_exists($_POST["user_ip"] ,$_SESSION['data'])) {
                array_push($_SESSION['data'][$_POST["user_ip"]]['img'], $_POST["img"]);
                array_push($_SESSION['data'][$_POST["user_ip"]]['link'], $_POST["link"]);
            }else {
                $_SESSION['data'][$_POST["user_ip"]] = array(
                    "img" =>array($_POST["img"]),
                    "link" =>array($_POST["link"]),
                );
            }
        }

    $fd = fopen("session.txt", 'w') or die("не удалось создать файл");
    $str_value = serialize($_SESSION['data']);
    fwrite($fd, $str_value);
    fclose($fd);

} else {
    header('HTTP/1.1 404 Not Found');
    header("Status: 404 Not Found");
}

