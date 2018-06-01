<?php

session_start();

if(!empty($_POST["user_ip"])){
    if (isset($_POST["delete_one"])) {

        $delete = (int)$_POST["delete_one"];
        $i = $_POST["user_ip"];
        unset($_SESSION['data'][$i]['img'][$delete]);
        unset($_SESSION['data'][$i]['link'][$delete]);
        sort($_SESSION['data'][$i]['img']);
        sort($_SESSION['data'][$i]['link']);

    } elseif (isset($_POST["delete_all"])) {

        $i = $_POST["user_ip"];
        $_SESSION['data'][$i]['img'] = array();
        $_SESSION['data'][$i]['link'] = array();

    }


    $fd = fopen("session.txt", 'w') or die("не удалось создать файл");
    $str_value = serialize($_SESSION['data']);
    fwrite($fd, $str_value);
    fclose($fd);

} else {
    header('HTTP/1.1 404 Not Found');
    header("Status: 404 Not Found");
}
