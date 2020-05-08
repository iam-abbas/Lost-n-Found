<?php


function redirect($url)
{
    header('Location: ' . $url);
    die();
}


function CheckLogin() {
    if(!isset($_SESSION['id'])) {
        redirect('login.php?er=1');
    }
}